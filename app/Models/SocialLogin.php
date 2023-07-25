<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLogin extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function getId($key, $default = null)
    {
        $socialLogin = self::where('id', $key)->first();

        if (isset($socialLogin)) {
            return $socialLogin;
        } else {
            return $default;
        }
    }
}
