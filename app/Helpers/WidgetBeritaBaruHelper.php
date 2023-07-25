<?php

use App\Models\Post;
use App\Models\Widget;

if (!function_exists('berita_baru')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function berita_baru($key, $default = null)
    {
        return Widget::getType($key, $default);
    }
}
