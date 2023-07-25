<?php

use App\Models\SocialLogin;

if (!function_exists('socialLogin')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function socialLogin($key, $default = null)
    {
        return SocialLogin::getId($key, $default);
    }
}
