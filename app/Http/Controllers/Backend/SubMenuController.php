<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SubMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubMenuController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'menu_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
        ]);

        SubMenu::create([
            'menu_id' => $request->menu_id,
            'title' => $request->title,
            'url' => $request->url,
            'icon' => $request->icon,
            'target' => $request->target,
            'order' => $request->order,
        ]);

        Session::flash('success', 'Sub menu created successfully!');
        return back();
    }

    public function edit(Request $request, SubMenu $subMenu)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
        ]);

        $subMenu->update([
            'menu_id' => $request->menu_id,
            'title' => $request->title,
            'url' => $request->url,
            'icon' => $request->icon,
            'target' => $request->target,
            'order' => $request->order,
            'collapse' => $request->collapse,
        ]);

        Session::flash('success', 'Sub menu changed successfully!');
        return back();
    }

    public function delete(Request $request)
    {
        if ($request) {
            SubMenu::where('id', $request->id)->delete();
            return response()->json(['success' => 'The sub menu has been deleted successfully!']);
        }
        return response()->json(['error' => 'Data not found!']);
    }
}
