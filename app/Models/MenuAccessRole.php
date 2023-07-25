<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuAccessRole extends Model
{
    use HasFactory;
    protected $table = 'menu_access_role';
    protected $guarded = ['id'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id');
    }
}
