<?php

use App\Models\Categorie;

if (!function_exists('category')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function category($key, $default = null)
    {
        return Categorie::getSlug($key, $default);
    }
}
