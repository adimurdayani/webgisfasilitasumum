<?php

use App\Models\Visitor;

if (!function_exists('pengunjung')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function pengunjung()
    {
        $pengunjung = Visitor::count();
        return $pengunjung;
    }

    function kunjungan($date)
    {
        $pengunjung = Visitor::where('created_at', $date)->count();
        return $pengunjung;
    }
}
