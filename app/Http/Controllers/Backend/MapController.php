<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coordinate;
use App\Models\Map;
use App\Models\Region;
use App\Models\Village;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class MapController extends Controller
{
    public function index()
    {
        Gate::authorize('app.maps.index');
        $maps = Map::all();
        $regions = Region::orderBy('id', 'desc')->get();
        $coordinates = Coordinate::orderBy('id', 'desc')->get();
        return view('backend.maps.index', compact('maps', 'regions', 'coordinates'));
    }

    public function load_data()
    {
        $maps = Map::orderBy('id', 'desc')->get();
        return DataTables::of($maps)
            ->addColumn('region', function ($maps) {
                return $maps->region->name;
            })
            ->addColumn('village', function ($maps) {
                return $maps->village->name;
            })
            ->addColumn('created_at', function ($maps) {
                return Carbon::parse($maps->created_at)->locale('id')->diffForHumans();
            })
            ->make(true);
    }

    public function create()
    {
        Gate::authorize('app.maps.create');
        $regions = Region::orderBy('id', 'desc')->get();
        $maps = Map::all();
        return view('backend.maps.add-map', compact('regions', 'maps'));
    }

    public function village(Region $region)
    {
        if ($region) {
            $villages = Village::orderBy('id', 'desc')->where('region_id', $region->id)->get();
            return response()->json($villages);
        } else {
            return response()->json(['error' => 'Data tidak ditemukan']);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'region_id' => 'required|integer',
            'village_id' => 'required|integer',
        ]);

        if ($request->hasFile('geojson')) {
            $geojson = $request->file('geojson');
            $file_geojson = $geojson->getClientOriginalName();
            $geojson->storeAs('public/geojson/', $file_geojson);

            Map::create([
                'region_id' => $request->region_id,
                'village_id' => $request->village_id,
                'color' => $request->color,
                'geojson' => $file_geojson
            ]);

            Session::flash('success', 'Map created successfully!');
            return back();
        } else {
            Session::flash('success', 'File geojson not found!');
            return back();
        }
    }

    public function edit(Map $map)
    {
        if (empty($map->id)) {
            Session::flash('error', 'Map not found!');
            return back();
        } else {
            Gate::authorize('app.maps.edit');
            $regions = Region::orderBy('id', 'desc')->get();
            $maps = Map::all();
            return view('backend.maps.edit-map', compact('regions', 'maps', 'map'));
        }
    }

    public function update(Request $request, Map $map)
    {
        $this->validate($request, [
            'region_id' => 'required|integer',
            'village_id' => 'required|integer',
        ]);

        Storage::delete('public/geojson/' . $map->geojson);
        if ($request->hasFile('geojson')) {
            $geojson = $request->file('geojson');
            $file_geojson = $geojson->getClientOriginalName();

            $geojson->storeAs('public/geojson/', $file_geojson);

            $map->update([
                'region_id' => $request->region_id,
                'village_id' => $request->village_id,
                'color' => $request->color,
                'geojson' => $file_geojson
            ]);


            Session::flash('success', 'Map changed successfully!');
            return back();
        } else {
            $map->update([
                'region_id' => $request->region_id,
                'village_id' => $request->village_id,
                'color' => $request->color,
            ]);
            Session::flash('success', 'Map changed successfully!');
            return back();
        }
    }

    public function delete(Request $request)
    {
        if ($request->ajax()) {
            Map::where('id', $request->id)->delete();
            return response()->json(['success' => 'Map deleted successfully!']);
        }
        return response()->json(['error' => 'Map not found!']);
    }
}
