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

    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function village()
    {
        return $this->belongsTo(Village::class);
    }
}
