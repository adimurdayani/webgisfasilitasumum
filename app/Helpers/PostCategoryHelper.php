<?php

use App\Models\Post;

if (!function_exists('postCategory')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function postCategory($key, $default = null)
    {
        return Post::getCategory($key, $default);
    }
}
