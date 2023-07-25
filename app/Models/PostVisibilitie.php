<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostVisibilitie extends Model
{
    use HasFactory;
    protected $table = 'post_visibitilitie';
    protected $guarded = ['id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function visibility()
    {
        return $this->belongsTo(Visibilitie::class);
    }
}
