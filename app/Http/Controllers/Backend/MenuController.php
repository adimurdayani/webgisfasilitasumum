<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Role;
use App\Models\SubMenu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index()
    {
        Gate::authorize('app.menus.index');
        $menus = Menu::all();
        $submenus = SubMenu::all();
        $menuitems = MenuItem::all();
        $roles = Role::all();
        return view('backend.menu-backend.index', compact('menus', 'submenus', 'menuitems', 'roles'));
    }

    public function load_data()
    {
        $menus = Menu::all();
        return DataTables::of($menus)
            ->addColumn('created_at', function ($menus) {
                return Carbon::parse($menus->created_at)->locale('id')->diffForHumans();
            })
            ->make(true);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:menus,name',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        Menu::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description
        ]);

        return response()->json(['success' => 'Created menu successfully!']);
    }

    public function show(Request $request)
    {
        if ($request) {
            $menu = Menu::where('id', $request->id)->first();
            return response()->json($menu);
        }
        return response()->json(['error' => 'Data not found!']);
    }

    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        Menu::where('id', $request->id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description
        ]);

        return response()->json(['success' => 'Created menu successfully!']);
    }

    public function update_deletable(Request $request)
    {
        $menu = Menu::where('id', $request->id)->first();
        if ($menu->deletable == true) {
            $menu->update([
                'deletable' => false
            ]);
            return response()->json(['success' => 'The menu has been successfully activated!']);
        } else {
            $menu->update([
                'deletable' => true
            ]);
            return response()->json(['success' => 'The menu has been successfully activated!']);
        }
        return response()->json(['error' => 'Menu not found!']);
    }

    public function delete(Request $request)
    {
        if ($request) {
            Menu::where('id', $request->id)->delete();
            return response()->json(['success' => 'Deleted menu successfully!']);
        }
        return response()->json(['error' => 'Menu not found!']);
    }
}
