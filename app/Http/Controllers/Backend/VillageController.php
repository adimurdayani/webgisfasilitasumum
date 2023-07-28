<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\Village;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class VillageController extends Controller
{
    public function index()
    {
        Gate::authorize('app.villages.index');
        $regions = Region::orderBy('id', 'desc')->get();
        return view('backend.village.index', compact('regions'));
    }

    public function load_data()
    {
        $villages = Village::orderBy('id', 'desc')->get();
        return DataTables::of($villages)
            ->addColumn('created_at', function ($villages) {
                return Carbon::parse($villages->created_at)->locale('id')->diffForHumans();
            })
            ->addColumn('region', function ($villages) {
                return $villages->region->name;
            })
            ->make(true);
    }

    public function create(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'region_id' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json(['error', $validator->errors()]);
            }

            Village::create([
                'region_id' => $request->region_id,
                'name' => $request->name,
            ]);
            return response()->json(['success' => 'Data berhasil disimpan']);
        } else {
            return response()->json(['error' => 'Data gagal disimpan']);
        }
    }

    public function edit(Village $village)
    {
        $vill = Village::where('id', $village->id)->with(['region'])->first();
        if ($village) {
            return response()->json($vill);
        } else {
            return response()->json(['error' => 'Data gagal tidak ditemukan']);
        }
    }

    public function update(Request $request)
    {
        $village = Village::find($request->id);
        if ($village) {
            if ($request->ajax()) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'region_id' => 'required|integer',
                ]);

                if ($validator->fails()) {
                    return response()->json(['error', $validator->errors()]);
                }

                $village->update([
                    'region_id' => $request->region_id,
                    'name' => $request->name,
                ]);

                return response()->json(['success' => 'Data berhasil diubah']);
            } else {
                return response()->json(['error' => 'Data gagal diubah']);
            }
        } else {
            return response()->json(['error' => 'Data tidak ditemukan']);
        }
    }

    public function delete(Request $request)
    {
        $village = Village::find($request->id);
        if ($village) {
            if ($request->ajax()) {
                $village->delete();
                return response()->json(['success' => 'Data berhasil dihapus']);
            } else {
                return response()->json(['error' => 'Data gagal dihapus']);
            }
        } else {
            return response()->json(['error' => 'Data tidak ditemukan']);
        }
    }
}
