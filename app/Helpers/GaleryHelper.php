<?php

use App\Models\Galerie;

if (!function_exists('galery')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function galery()
    {
        $galery = Galerie::count();
        return $galery;
    }
}
