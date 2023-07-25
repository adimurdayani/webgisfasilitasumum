<?php

use App\Models\Dimensi;

if (!function_exists('dimensi')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function dimensi($key, $default = null)
    {
        return Dimensi::getLayananId($key, $default);
    }
}
