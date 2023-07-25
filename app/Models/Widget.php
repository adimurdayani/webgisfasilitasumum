<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function getLocation($key, $default = null)
    {
        $widget = self::where('location', $key)->first();

        if (isset($widget)) {
            return $widget;
        } else {
            return $default;
        }
    }


    public static function getType($key, $default = null)
    {
        $widget = self::where('content_type', $key)->first();

        if (isset($widget)) {
            return $widget;
        } else {
            return $default;
        }
    }
}
