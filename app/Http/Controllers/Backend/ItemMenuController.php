<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ItemMenuController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:menu_items,title|string|max:255',
            'url' => 'required|unique:menu_items,url|string|max:255',
        ]);

        MenuItem::create([
            'menu_id' => $request->menu_id,
            'submenu_id' => $request->submenu_id,
            'order' => $request->order,
            'title' => $request->title,
            'url' => $request->url,
        ]);

        Session::flash('success', 'Menu item created successfully!');
        return back();
    }

    public function edit(Request $request, MenuItem $menuItem)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
        ]);

        $menuItem->update([
            'order' => $request->order,
            'title' => $request->title,
            'url' => $request->url,
        ]);

        Session::flash('success', 'Menu item changed successfully!');
        return back();
    }

    public function delete(Request $request)
    {
        if ($request) {
            MenuItem::where('id', $request->id)->delete();
            return response()->json(['success' => 'Menu item deleted successfully!']);
        }
        return response()->json(['error' => 'Menu item not found!']);
    }
}
