<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Visibilitie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class VisibilityController extends Controller
{
    public function index()
    {
        Gate::authorize('app.visibilities.index');
        return view('backend.visibility.index');
    }

    public function load_data()
    {
        $visibilities = Visibilitie::all();
        return DataTables::of($visibilities)
            ->addColumn('created_at', function ($visibilities) {
                return Carbon::parse($visibilities->created_at)->locale('id')->diffForHumans();
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

        if ($request->ajax()) {
            Visibilitie::create([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return response()->json(['success' => 'Visibility created successfully!']);
        }
    }

    public function edit(Request $request)
    {
        if ($request->ajax()) {
            Visibilitie::find($request->id)->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return response()->json(['success' => 'Visibility changed successfully!']);
        }
    }

    public function delete(Request $request)
    {
        if ($request->ajax()) {
            Visibilitie::where('id', $request->id)->delete();
            return response()->json(['success' => 'Visibility deleted successfully!']);
        }
        return response()->json(['success' => 'Visibility not found!']);
    }
}
