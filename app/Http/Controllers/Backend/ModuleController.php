<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class ModuleController extends Controller
{
    public function index()
    {
        Gate::authorize('app.modules.index');
        $modules = Module::all();
        return view('backend.module.index', compact('modules'));
    }

    public function load_data()
    {
        $modules = Module::all();
        return DataTables::of($modules)
            ->addColumn('created_at', function ($modules) {
                return Carbon::parse($modules->created_at)->locale('id')->diffForHumans();;
            })->toJson();
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255'
        ]);

        Module::create([
            'name' => $request->name
        ]);

        Session::flash('success', 'Module created successfully!');
        return redirect()->back();
    }

    public function module_editable(Request $request)
    {
        if ($request->ajax()) {
            Module::find($request->id)->update([
                "name" => $request->name,
            ]);

            return response()->json(['success' => 'Module updated successfully!']);
        }
        return response()->json(['error' => 'Modul not found!']);
    }

    public function hapus(Request $request)
    {
        if (empty($request->id)) {
            return response()->json(['error' => 'Module not found!']);
        } else {
            Module::where('id', $request->id)->delete();
            return response()->json(['success' => 'Module deleted successfully!']);
        }
    }
}
