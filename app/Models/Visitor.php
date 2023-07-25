<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function getIp($key, $default = null)
    {
        $visitor = self::where('ip', $key)->first();
        if (isset($visitor)) {
            return $visitor;
        } else {
            return $default;
        }
    }
}
