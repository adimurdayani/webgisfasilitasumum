<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coordinate;
use App\Models\Education;
use App\Models\File;
use App\Models\Map;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class CoordinateController extends Controller
{
    public function index()
    {
        Gate::authorize('app.coordinates.index');

        $maps = Map::all();
        $regions = Region::where('name', 'Kecamatan Lamasi Timur')->get();
        $educations = Education::orderBy('id', 'desc')->get();
        $coordinates = Coordinate::orderBy('id', 'desc')->get();
        return view('backend.map-latlng.index', compact('coordinates', 'maps', 'regions', 'educations'));
    }

    public function load_data()
    {
        $coordinate = Coordinate::where('type', 'coordinate')->orderBy('id', 'desc')->get();
        return DataTables::of($coordinate)
            ->addColumn('region', function ($coordinate) {
                return $coordinate->region->name;
            })
            ->addColumn('education', function ($coordinate) {
                return $coordinate->education->name;
            })
            ->addColumn('created_at', function ($coordinate) {
                return Carbon::parse($coordinate->created_at)->locale('id')->diffForHumans();
            })
            ->make(true);
    }

    public function load_file()
    {
        $coordinate = Coordinate::where('type', 'file')->orderBy('id', 'desc')->get();
        return DataTables::of($coordinate)
            ->addColumn('created_at', function ($coordinate) {
                return Carbon::parse($coordinate->created_at)->locale('id')->diffForHumans();
            })
            ->make(true);
    }

    public function create()
    {
        Gate::authorize('app.coordinates.create');
        $educations = Education::orderBy('id', 'desc')->get();
        $regions = Region::orderBy('id', 'desc')->get();
        $coordinates = Coordinate::all();
        $maps = Map::all();
        $type = ['file', 'coordinate'];
        return view('backend.map-latlng.add-coordinate', compact('educations', 'regions', 'coordinates', 'maps', 'type'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'region_id' => 'required|integer',
            'village_id' => 'required|integer',
            'education_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'lat' => 'required',
            'lon' => 'required',
        ]);

        $tmpfile_img = File::where('folder', $request->image)->first();

        if ($tmpfile_img) {
            Storage::copy('public/img/tmp/' . $tmpfile_img->folder . '/' . $tmpfile_img->file, 'public/img/' . $tmpfile_img->folder . '/' . $tmpfile_img->file);

            Coordinate::create([
                'region_id' => $request->region_id,
                'village_id' => $request->village_id,
                'education_id' => $request->education_id,
                'name' => $request->name,
                'description' => $request->description,
                'lat' => $request->lat,
                'lon' => $request->lon,
                'color' => $request->color,
                'icon_marker' => $request->icon_marker,
                'type' => 'coordinate',
                'image' => $tmpfile_img->folder . '/' . $tmpfile_img->file,
            ]);

            Storage::deleteDirectory('public/img/tmp/' . $tmpfile_img->folder);
            $tmpfile_img->delete();

            Session::flash('success', 'Coordinate created successfully!');
            return back();
        } else {
            Session::flash('error', 'Coordinate gagal disimpan!');
            return back();
        }
    }

    public function store_file(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        if ($request->hasFile('geojson')) {
            $geojson = $request->file('geojson');
            $file_geojson = $geojson->getClientOriginalName();
            $geojson->storeAs('public/geojson/', $file_geojson);

            Coordinate::create([
                'name' => $request->name,
                'description' => $request->description,
                'color' => $request->color,
                'icon_marker' => $request->icon_marker,
                'type' => 'file',
                'geojson' => $file_geojson
            ]);
            Session::flash('success', 'Coordinate created successfully!');
            return back();
        } else {
            Session::flash('error', 'File coordinate not found!');
            return back();
        }
    }

    public function edit(Coordinate $coordinate)
    {
        if (empty($coordinate->id)) {
            Session::flash('error', 'Coordinate not found!');
            return back();
        } else {
            Gate::authorize('app.coordinates.edit');
            $educations = Education::orderBy('id', 'desc')->get();
            $regions = Region::orderBy('id', 'desc')->get();
            $coordinates = Coordinate::all();
            $maps = Map::all();
            $type = ['file', 'coordinate'];
            return view('backend.map-latlng.edit-coordinate', compact('educations', 'regions', 'coordinates', 'maps', 'coordinate', 'type'));
        }
    }

    public function edit_file(Coordinate $coordinate)
    {
        if (empty($coordinate->id)) {
            Session::flash('error', 'File coordinate not found!');
            return back();
        } else {
            Gate::authorize('app.coordinates.edit');
            $coordinates = Coordinate::all();
            $maps = Map::all();
            return view('backend.map-latlng.edit-file-coordinate', compact('coordinates', 'maps', 'coordinate'));
        }
    }

    public function update(Request $request, Coordinate $coordinate)
    {
        $this->validate($request, [
            'region_id' => 'required|integer',
            'village_id' => 'required|integer',
            'education_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'lat' => 'required',
            'lon' => 'required',
        ]);

        $tmpfile_img = File::where('folder', $request->image)->first();
        if ($tmpfile_img) {
            Storage::copy('public/img/tmp/' . $tmpfile_img->folder . '/' . $tmpfile_img->file, 'public/img/' . $tmpfile_img->folder . '/' . $tmpfile_img->file);
            Storage::delete('public/img/' . $coordinate->image);

            $coordinate->update([
                'region_id' => $request->region_id,
                'village_id' => $request->village_id,
                'education_id' => $request->education_id,
                'name' => $request->name,
                'description' => $request->description,
                'lat' => $request->lat,
                'lon' => $request->lon,
                'color' => $request->color,
                'icon_marker' => $request->icon_marker,
                'image' => $tmpfile_img->folder . '/' . $tmpfile_img->file,
            ]);

            Storage::deleteDirectory('public/img/tmp/' . $tmpfile_img->folder);
            $tmpfile_img->delete();
        } else {
            $coordinate->update([
                'region_id' => $request->region_id,
                'village_id' => $request->village_id,
                'education_id' => $request->education_id,
                'name' => $request->name,
                'description' => $request->description,
                'lat' => $request->lat,
                'lon' => $request->lon,
                'color' => $request->color,
                'icon_marker' => $request->icon_marker,
            ]);
        }


        Session::flash('success', 'Coordinate changed successfully!');
        return back();
    }

    public function update_file(Request $request, Coordinate $coordinate)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        if ($request->hasFile('geojson')) {
            $geojson = $request->file('geojson');
            $file_geojson = $geojson->getClientOriginalName();
            $geojson->storeAs('public/geojson/', $file_geojson);

            $coordinate->update([
                'name' => $request->name,
                'description' => $request->description,
                'color' => $request->color,
                'icon_marker' => $request->icon_marker,
                'type' => 'file',
                'geojson' => $file_geojson
            ]);
            Storage::delete('public/geojson/', $coordinate->geojson);
            Session::flash('success', 'Coordinate created successfully!');
            return back();
        } else {
            $coordinate->update([
                'name' => $request->name,
                'description' => $request->description,
                'color' => $request->color,
                'icon_marker' => $request->icon_marker,
                'type' => 'file',
            ]);
            Session::flash('success', 'Coordinate created successfully!');
            return back();
        }
    }

    public function delete(Request $request)
    {
        if ($request->ajax()) {
            Coordinate::where('id', $request->id)->delete();
            return response()->json(['success' => 'Coordinate deleted successfully!']);
        }
        return response()->json(['error' => 'Coordinate not found!']);
    }

    public function tmpupload_img(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_image = $image->getClientOriginalName();

            $folder = uniqid('post', true);
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
