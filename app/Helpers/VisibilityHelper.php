<?php

use App\Models\Visibilitie;

if (!function_exists('visibility')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function visibility($key, $default = null)
    {
        return Visibilitie::getDescription($key, $default);
    }
}
