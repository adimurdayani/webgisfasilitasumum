<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index()
    {
        Gate::authorize('app.dashboard');
        $visitor_browser = Visitor::groupBy('browser')->select('browser', DB::raw('count(*) as total'))->get();
        $label         = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        for($bulan=1;$bulan < 13;$bulan++){
            $chartvisitor     = collect(DB::SELECT("SELECT count(id) AS jumlah from visitors where month(created_at)='$bulan'"))->first();
            $jml_visitor[] = $chartvisitor->jumlah;
        }
        for($bulan=1;$bulan < 13;$bulan++){
            $chartvisit     = collect(DB::SELECT("SELECT sum(hits) AS jumlah from visitors where month(created_at)='$bulan'"))->first();
            $jml_visit[] = $chartvisit->jumlah;
        }

        return view('backend.dashboard.index', compact('jml_visitor', 'visitor_browser', 'jml_visit','label'));
    }
}
