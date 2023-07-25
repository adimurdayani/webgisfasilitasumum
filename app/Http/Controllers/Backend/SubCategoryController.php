<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\SubCategorie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function index()
    {
        Gate::authorize('app.subcategories.index');
        $categories = Categorie::all();
        return view('backend.sub-categories.index', compact('categories'));
    }

    public function load_data()
    {
        $sub_category = SubCategorie::all();
        return DataTables::of($sub_category)
            ->addColumn('category', function ($sub_category) {
                return $sub_category->category->title;
            })
            ->addColumn('created_at', function ($sub_category) {
                return Carbon::parse($sub_category->created_at)->locale('id')->diffForHumans();
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
            SubCategorie::create([
                'categorie_id' => $request->id_category,
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,
                'keywords' => $request->keywords,
            ]);

            return response()->json(['success' => 'Category created successfully!']);
        }
    }

    public function edit(SubCategorie $subCategorie)
    {
        if (empty($subCategorie->id)) {
            Session::flash('error', 'Sub category not found!');
            return back();
        } else {
            Gate::authorize('app.subcategories.edit');
            $categories = Categorie::all();
            return view('backend.sub-categories.edit', compact('subCategorie', 'categories'));
        }
    }

    public function update(Request $request, SubCategorie $subCategorie)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
        ]);

        $subCategorie->update([
            'categorie_id' => $request->id_category,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'keywords' => $request->keywords,
        ]);

        Session::flash('success', 'Sub category created successfully!');
        return back();
    }

    public function delete(Request $request)
    {
        if ($request->ajax()) {
            SubCategorie::where('id', $request->id)->delete();
            return response()->json(['success' => 'Sub category deleted successfully!']);
        }
        return response()->json(['success' => 'Sub category not found!']);
    }
}
