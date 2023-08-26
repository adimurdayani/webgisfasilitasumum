<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Galerie;
use App\Models\Tab;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class GaleryController extends Controller
{
    public function index()
    {
        Gate::authorize('app.galeries.index');
        return view('backend.galery.index');
    }

    public function load_data()
    {
        $galeries = Galerie::orderBy('id', 'desc')->get();
        return DataTables::of($galeries)
            ->editColumn('title_image', function ($galeri) {
                return '<div class="form-inline"><img src="' . asset('storage/public/img') . '/' . $galeri->image . '" class="img-thumbnail m-1" title="Img Post" width="20%"> ' . $galeri->title . '</div>';
            })
            ->escapeColumns([])
            ->addColumn('tabs', function ($galeries) {
                return $galeries->tabs->name;
            })
            ->addColumn('created_at', function ($galeries) {
                return Carbon::parse($galeries->created_at)->locale('id')->diffForHumans();
            })
            ->toJson();
    }

    public function create()
    {
        Gate::authorize('app.galeries.create');
        $tabs = Tab::orderBy('id', 'desc')->get();
        return view('backend.galery.add-galery', compact('tabs'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'tab_id' => 'required|integer',
        ]);

        $image = File::where('folder', $request->image)->first();

        if ($image) {
            Storage::copy('public/img/tmp/' . $image->folder . '/' . $image->file, 'public/img/' . $image->folder . '/' . $image->file);

            Galerie::create([
                'tab_id' => $request->tab_id,
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'image' => $image->folder . '/' . $image->file,
            ]);

            Storage::deleteDirectory('public/img/tmp/' . $image->folder);
            $image->delete();

            Session::flash('success', 'Galery created successfully!');
            return redirect()->back();
        } else {
            Session::flash('error', 'Image not found!');
            return redirect()->back();
        }
    }

    public function edit(Galerie $galerie)
    {
        if (empty($galerie->id)) {
            Session::flash('error', 'Galery not found!');
            return redirect()->back();
        } else {
            Gate::authorize('app.galeries.edit');
            $tabs = Tab::orderBy('id', 'desc')->get();
            return view('backend.galery.edit-galery', compact('galerie', 'tabs'));
        }
    }

    public function update(Request $request, Galerie $galerie)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'tab_id' => 'required|integer',
        ]);

        $image = File::where('folder', $request->image)->first();

        if ($image) {
            Storage::copy('public/img/tmp/' . $image->folder . '/' . $image->file, 'public/img/' . $image->folder . '/' . $image->file);
            Storage::delete('public/img/' . $image->img_user);

            $galerie->update([
                'tab_id' => $request->tab_id,
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'image' => $image->folder . '/' . $image->file,
            ]);

            Storage::deleteDirectory('public/img/tmp/' . $image->folder);
            $image->delete();

            Session::flash('success', 'Galery changed successfully');
            return back();
        } else {
            $galerie->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'tab_id' => $request->tab_id,
            ]);

            Session::flash('success', 'Galery changed successfully');
            return back();
        }
    }

    public function delete(Request $request)
    {
        if ($request->ajax()) {
            Galerie::where('id', $request->id)->delete();
            return response()->json(['success' => 'Galery deleted successfully!']);
        }
        return response()->json(['error' => 'Galery not found!']);
    }

    public function tmpupload_img(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_image = $image->getClientOriginalName();

            $folder = uniqid('galery', true);
            $image->storeAs('public/img/tmp/' . $folder, $file_image);

            File::create([
                'folder' => $folder,
                'file' => $file_image,
            ]);
            return $folder;
        }

        return response()->json(['error' => 'Image not found!']);
    }

    public function tmpdelete_img()
    {
        $tmp_file = File::where('folder', request()->getContent())->first();
        if ($tmp_file) {
            Storage::deleteDirectory('public/img/tmp/' . $tmp_file->folder);
            $tmp_file->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => 'Image not found!']);
    }
}
