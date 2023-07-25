<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visibilitie extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function post_visibility()
    {
        return $this->belongsTo(PostVisibilitie::class, 'visibilitie_id')->orderBy('id', 'desc');
    }

    public static function getDescription($key, $default = null)
    {
        $visibility = self::where('description', $key)->first();

        if (isset($visibility)) {
            return $visibility;
        } else {
            return $default;
        }
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
