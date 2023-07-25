<?php

use App\Models\Widget;

if (!function_exists('widget')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function widget($key, $default = null)
    {
        return Widget::getLocation($key, $default);
    }
}
