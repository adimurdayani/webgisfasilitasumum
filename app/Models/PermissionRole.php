<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    use HasFactory;
    protected $table = 'permission_role';
    protected $guarded = ['id'];

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'id');
    }
}
