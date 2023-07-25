<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function getAppName($key, $default = null)
    {
        $generalSetting = self::where('id', $key)->first();

        if (isset($generalSetting)) {
            return $generalSetting;
        } else {
            return $default;
        }
    }
}
