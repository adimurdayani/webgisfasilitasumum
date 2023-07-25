<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Tab;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class TapController extends Controller
{
    public function index()
    {
        Gate::authorize('app.tabs.index');
        return view('backend.galery.tab-galeri');
    }

    public function load_data()
    {
        $tabs = Tab::orderBy('id', 'desc')->get();
        return DataTables::of($tabs)
            ->addColumn('created_at', function ($tabs) {
                return Carbon::parse($tabs->created_at)->locale('id')->diffForHumans();
            })
            ->make(true);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        Tab::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json(['success' => 'Tab created successfully!']);
    }

    public function show_edit(Request $request)
    {
        if ($request->ajax()) {
            $tab = Tab::where('id', $request->id)->first();
            return response()->json($tab);
        }
        return response()->json(['error' => 'Tab not found!']);
    }

    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        Tab::where('id', $request->id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json(['success' => 'Tab changed successfully!']);
    }

    public function delete(Request $request)
    {
        if ($request->ajax()) {
            Tab::where('id', $request->id)->delete();
            return response()->json(['success' => 'Tab deleted successfully!']);
        }
        return response()->json(['error' => 'Tab not found!']);
    }
}
