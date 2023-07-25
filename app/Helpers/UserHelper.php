<?php

use App\Models\Role;

if (!function_exists('user')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function user()
    {
        $role = Role::where('id', 1)->first();
        return $role->users->count();
    }
}
