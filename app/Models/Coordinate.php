<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinate extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function education()
    {
        return $this->belongsTo(Education::class);
    }
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
