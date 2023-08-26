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
        $categories = Categorie::orderBy('id', 'desc')->get();
        return DataTables::of($categories)
            ->addColumn('created_at', function ($categories) {
                return Carbon::parse($categories->created_at)->locale('id')->diffForHumans();
            })
            ->toJson();
    }

    public function create(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        }

        if (!$request->ajax()) {
            return response()->json(['errors' => 'Unauthorized']);
        } else {
            Categorie::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,
                'keywords' => $request->keywords,
            ]);

            return response()->json(['success' => 'Category created successfully!']);
        }
    }

    public function update(Request $request)
    {
        if ($request->action == 'edit') {
            $validator = Validator::make($request->all(), [
                'title' => 'required||string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()]);
            }

            if (!$request->ajax()) {
                return response()->json(['error' => 'Unauthorized!']);
            } else {
                $category = Categorie::find($request->id)->update([
                    'title' => $request->title,
                    'slug' => Str::slug($request->title),
                    'description' => $request->title,
                ]);

                if ($category) {
                    return response()->json(['success' => 'Category updated successfully!']);
                }
            }
            return response()->json(['error' => 'Something wen wrong!']);
        }

        if ($request->action == 'delete') {
            if (!$request->ajax()) {
                return response()->json(['error' => 'Unauthorized!']);
            } else {
                Categorie::find($request->id)->delete();
                return response()->json(['success' => 'Category deleted successfully!']);
            }
            return response()->json(['error' => 'Something wen wrong!']);
        }
    }
}
