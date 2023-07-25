<?php

use App\Models\GeneralSetting;

if (!function_exists('setting')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function setting($key, $default = null)
    {
        return GeneralSetting::getAppName($key, $default);
    }
}
