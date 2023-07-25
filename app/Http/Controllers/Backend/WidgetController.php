<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Widget;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;

class WidgetController extends Controller
{
    public function index()
    {
        Gate::authorize('app.widgets.index');
        return view('backend.widget.index');
    }

    public function load_data()
    {
        $widgets = Widget::orderBy('id', 'desc')->get();
        return DataTables::of($widgets)
            ->editColumn('status', function ($widgets) {
                if ($widgets->is_active == true) {
                    return '<div class="badge badge-success">Show</div>';
                } else {
                    return '<div class="badge badge-secondary">Hide</div>';
                }
            })
            ->escapeColumns([])
            ->addColumn('created_at', function ($widgets) {
                return Carbon::parse($widgets->created_at)->locale('id')->diffForHumans();
            })
            ->make(true);
    }

    public function create()
    {
        Gate::authorize('app.widgets.create');
        return view('backend.widget.add-widget');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'content_type' => 'required|string|max:255',
        ]);

        Widget::create([
            'title' => $request->title,
            'location' => $request->location,
            'content_type' => $request->content_type,
            'order' => $request->order,
            'is_active' => $request->is_active,
        ]);
        Session::flash('success', 'Widget created successfully!');
        return back();
    }

    public function edit(Widget $widget)
    {
        if (empty($widget->id)) {
            Session::flash('error', 'Widget not found!');
            return back();
        } else {
            Gate::authorize('app.widgets.edit');
            return view('backend.widget.edit-widget', compact('widget'));
        }
    }

    public function update(Request $request, Widget $widget)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'content_type' => 'required|string|max:255',
        ]);

        $widget->update([
            'title' => $request->title,
            'location' => $request->location,
            'content_type' => $request->content_type,
            'order' => $request->order,
            'is_active' => $request->is_active,
        ]);
        Session::flash('success', 'Widget changed successfully!');
        return back();
    }

    public function delete(Request $request)
    {
        if ($request->ajax()) {
            Widget::where('id', $request->id)->delete();
            return response()->json(['success' => 'Widget deleted successfully!']);
        }
        return response()->json(['error' => 'Widget not found!']);
    }
}
