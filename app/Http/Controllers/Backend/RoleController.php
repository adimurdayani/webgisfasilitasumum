<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuAccessRole;
use App\Models\MenuItem;
use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;
use App\Models\SubMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index()
    {
        Gate::authorize('app.roles.index');
        return view('backend.role.index');
    }

    public function load_data()
    {
        $role = Role::with(['permissions'])->get();
        return DataTables::of($role)
            ->addColumn('roles', function ($role) {
                return $role;
            })
            ->toJson();
    }

    public function create()
    {
        Gate::authorize('app.roles.create');
        $modules = Module::all();
        return view('backend.role.create', compact('modules'));
    }

    public function post(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name|string|max:255',
            'permissions' => 'required|array',
            'permissions.*' => 'integer',
        ]);

        $role = Role::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        $role->permissions()->sync($request->input('permissions'), []);

        Session::flash('success', 'Role created successfully!');
        return redirect()->back();
    }

    public function edit(Role $role)
    {
        if (empty($role->id)) {
            Session::flash('error', 'Role not found!');
            return redirect()->back();
        } else {
            Gate::authorize('app.roles.edit');
            $modules = Module::all();
            $menus = Menu::all();
            return view('backend.role.edit', compact('role', 'modules', 'menus'));
        }
    }

    public function load_submenu(Request $request)
    {
        if ($request->ajax()) {
            $submenu = SubMenu::where('menu_id', $request->id)->get();
            return response()->json($submenu);
        }
        return response()->json(['error' => 'Menu Id not found!']);
    }
    public function load_menuitem(Request $request)
    {
        if ($request->ajax()) {
            $submenu = MenuItem::where('submenu_id', $request->id)->get();
            return response()->json($submenu);
        }
        return response()->json(['error' => 'Menu Id not found!']);
    }

    public function update_menu_access(Request $request, Role $role)
    {

        $this->validate($request, [
            'menu_id' => 'required|integer'
        ]);

        MenuAccessRole::create([
            'menu_id' => $request->menu_id,
            'submenu_id' => $request->submenu_id,
            'menuitem_id' => $request->menuitem_id,
            'role_id' => $role->id,
        ]);
        Session::flash('success', 'Menu access successfully created!');
        return back();
    }

    public function update(Request $request, Role $role)
    {
        // return $request;
        $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        $role->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);
        $role->permissions()->sync($request->input('permissions'), []);

        Session::flash('success', 'Data berhasil diubah!');
        return redirect()->back();
    }

    public function hapus(Request $request)
    {
        Gate::authorize('app.roles.destroy');
        try {
            Role::where('id', $request->id)->delete();
            return response()->json(['success' => 'Data berhasil dihapus!']);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => $e->errorInfo[2]]);
        }
    }

    public function hapus_rolePermission(Request $request)
    {
        Permission::where('id', $request->id)->delete();
        return response()->json(['success' => 'Data berhasil dihapus!']);
    }

    public function sitemap(Role $role)
    {
        Gate::authorize('app.roles.sitemap');
        $modules = Module::all();
        $menus = Menu::all();
        return view('backend.role.sitemap', compact('role', 'modules', 'menus'));
    }
}
