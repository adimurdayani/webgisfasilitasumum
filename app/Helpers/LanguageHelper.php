<?php

use App\Models\Language;

if (!function_exists('language')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function language()
    {
        return Language::where('status', 1)->get();
    }
}
