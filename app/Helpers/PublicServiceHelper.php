<?php

use App\Models\PublicService;

if (!function_exists('publicService')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function publicService($key,$key2, $default = null)
    {
        return PublicService::getCategory($key,$key2, $default);
    }
}
