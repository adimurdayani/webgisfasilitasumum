<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class EducationController extends Controller
{
    public function index()
    {
        Gate::authorize('app.educations.index');
        return view('backend.education.index');
    }

    public function load_data()
    {
        $quick_win = Education::orderBy('id', 'desc')->get();
        return DataTables::of($quick_win)
            ->addColumn('created_at', function ($quick_win) {
                return Carbon::parse($quick_win->created_at)->locale('id')->diffForHumans();
            })
            ->toJson();
    }

    public function create(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validasi->fails()) {
            return response()->json(['error' => $validasi->errors()]);
        }

        if ($request->ajax()) {
            Education::create([
                'name' => $request->name,
                'description' => $request->description
            ]);

            return response()->json(['success' => 'Education created successfully!']);
        }

        return response()->json(['error' => 'Education not found!']);
    }

    public function show(Request $request)
    {
        if ($request->ajax()) {
            $quick_win = Education::where('id', $request->id)->first();
            return response()->json($quick_win);
        }
        return  response()->json(['error' => 'Education not found!']);
    }

    public function edit(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validasi->fails()) {
            return response()->json(['error' => $validasi->errors()]);
        }

        $quick_win = Education::where('id', $request->id)->first();
        if ($request->ajax()) {
            $quick_win->update([
                'name' => $request->name,
                'description' => $request->description
            ]);

            return response()->json(['success' => 'Education changed successfully!']);
        }

        return response()->json(['error' => 'Education not found!']);
    }

    public function delete(Request $request)
    {
        if ($request->ajax()) {
            Education::where('id', $request->id)->delete();
            return response()->json(['success' => 'Education deleted successfully!']);
        }

        return response()->json(['error' => 'Education not found!']);
    }
}
