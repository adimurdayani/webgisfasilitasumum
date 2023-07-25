<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{

    public function load_data()
    {
        $languages = Language::orderBy('id', 'desc')->get();
        return DataTables::of($languages)
            ->editColumn('status_lang', function ($languages) {
                if ($languages->status == true) {
                    return '<div class="badge badge-success">Active</div>';
                } else {
                    return '<div class="badge badge-secondary">Inactive</div>';
                }
            })
            ->escapeColumns([])
            ->addColumn('created_at', function ($languages) {
                return Carbon::parse($languages->created_at)->locale('id')->diffForHumans();
            })
            ->make(true);
    }

    public function create()
    {
        Gate::authorize('app.countries.create');
        return view('backend.settings.add-lang');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'flag' => 'required|string|max:255',
        ]);

        Language::create([
            'name' => $request->name,
            'code' => $request->code,
            'flag' => $request->flag,
        ]);
        Session::flash('success', 'Language added successfully!');
        return redirect()->back();
    }

    public function edit(Request $request, Language $language)
    {
        Gate::authorize('app.countries.edit');
        if ($language) {
            return view('backend.settings.edit-lang', compact('language'));
        }
        Session::flash('error', 'Language not found!');
        return redirect()->back();
    }

    public function update(Request $request, Language $language)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'flag' => 'required|string|max:255',
        ]);

        $language->update([
            'name' => $request->name,
            'code' => $request->code,
            'status' => $request->status,
            'flag' => $request->flag,
        ]);
        Session::flash('success', 'Language updated successfully!');
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        if ($request->ajax()) {
            Language::where('id', $request->id)->delete();
            return response()->json(['success' => 'Language deleted successfully!']);
        }
        return response()->json(['error' => 'Language not found!']);
    }
}
