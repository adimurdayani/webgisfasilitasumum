<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function subCategores()
    {
        return $this->hasMany(SubCategorie::class);
    }

    public static function getSlug($key, $default = null)
    {
        $category = self::where('slug', $key)->first();

        if (isset($category)) {
            return $category;
        } else {
            return $default;
        }
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('id', 'desc');
    }
}
