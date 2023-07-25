<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        Gate::authorize('app.categories.index');
        return view('backend.categories.index');
    }

    public function load_data()
    {
        $categories = Categorie::all();
        return DataTables::of($categories)
            ->addColumn('created_at', function ($categories) {
                return Carbon::parse($categories->created_at)->locale('id')->diffForHumans();
            })
            ->make(true);
    }

    public function create(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        }

        if ($request->ajax()) {
            Categorie::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,
                'keywords' => $request->keywords,
            ]);

            return response()->json(['success' => 'Category created successfully!']);
        }
    }

    public function edit(Categorie $categorie)
    {
        if (!$categorie) {
            Session::flash('error', 'Category not found!');
            return redirect()->back();
        } else {
            Gate::authorize('app.categories.edit');
            return view('backend.categories.edit', compact('categorie'));
        }
    }

    public function update(Request $request, Categorie $categorie)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
        ]);

        $categorie->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'keywords' => $request->keywords,
            'is_active' => $request->is_active,
        ]);

        Session::flash('success', 'Category changed successfully');
        return back();
    }

    public function delete(Request $request)
    {
        if ($request->ajax()) {
            Categorie::where('id', $request->id)->delete();

            return response()->json(['success' => 'Category successfully deleted!']);
        }
        return response()->json(['errors' => 'ID Category not found!']);
    }
}
