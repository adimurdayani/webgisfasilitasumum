<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Permission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    public function index()
    {
        Gate::authorize('app.permissions.index');
        $modules = Module::all();
        $permissions = Permission::all();
        return view('backend.permission.index', compact('modules', 'permissions'));
    }

    public function load_data()
    {
        $permision = Permission::all();
        return DataTables::of($permision)
            ->addColumn('created_at', function (Permission $permisions) {
                $time = Carbon::parse($permisions->created_at)->locale('id')->diffForHumans();
                return $time;
            })
            ->make(true);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'module_id' => 'required|integer',
            'name' => 'required|unique:permissions,name|string|max:255',
            'slug' => 'required|unique:permissions,slug|string|max:255',
        ]);

        Permission::create([
            'module_id' => $request->module_id,
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        Session::flash('success', 'Data berhasil disimpan!');
        return redirect()->back();
    }

    public function update(Request $request, Permission $permission)
    {
        $this->validate($request, [
            'module_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
        ]);

        $permission->update([
            'module_id' => $request->module_id,
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        Session::flash('success', 'Data berhasil diubah!');
        return redirect()->back();
    }

    public function hapus(Request $request)
    {
        try {
            Permission::where('id', $request->id)->delete();
            return response()->json(['success' => 'Data berhasil disipman']);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => $e->errorInfo[2]]);
        }
    }
}
