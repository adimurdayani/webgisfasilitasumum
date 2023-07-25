<?php

use App\Models\Post;

if (!function_exists('post')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function post($key)
    {
        $post = Post::where('publish', $key)->count();
        return $post;
    }
}
