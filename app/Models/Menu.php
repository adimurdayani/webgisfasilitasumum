<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function subMenus()
    {
        return $this->hasMany(SubMenu::class)->orderBy('order');
    }

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class, 'menu_id')->orderBy('order');
    }
}
