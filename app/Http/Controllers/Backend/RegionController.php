<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class RegionController extends Controller
{
    public function index()
    {
        Gate::authorize('app.regions.index');
        return view('backend.region.index');
    }

    public function load_data()
    {
        $quick_win = Region::orderBy('id', 'desc')->get();
        return DataTables::of($quick_win)
            ->addColumn('created_at', function ($quick_win) {
                return Carbon::parse($quick_win->created_at)->locale('id')->diffForHumans();
            })
            ->make(true);
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
            Region::create([
                'name' => $request->name,
                'slug' => Str::replace(" ", "", $request->name),
            ]);

            return response()->json(['success' => 'Region created successfully!']);
        }

        return response()->json(['error' => 'Region not found!']);
    }

    public function show(Request $request)
    {
        if ($request->ajax()) {
            $quick_win = Region::where('id', $request->id)->first();
            return response()->json($quick_win);
        }
        return  response()->json(['error' => 'Region not found!']);
    }

    public function edit(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validasi->fails()) {
            return response()->json(['error' => $validasi->errors()]);
        }

        $quick_win = Region::where('id', $request->id)->first();
        if ($request->ajax()) {
            $quick_win->update([
                'name' => $request->name,
                'slug' => Str::replace(" ", "", $request->name),
            ]);

            return response()->json(['success' => 'Region changed successfully!']);
        }

        return response()->json(['error' => 'Region not found!']);
    }

    public function delete(Request $request)
    {
        if ($request->ajax()) {
            Region::where('id', $request->id)->delete();
            return response()->json(['success' => 'Region deleted successfully!']);
        }

        return response()->json(['error' => 'Region not found!']);
    }
}
