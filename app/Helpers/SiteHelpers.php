<?php

namespace App\Helpers;

use App\Models\Categorie;
use App\Models\Document;
use App\Models\Menu;
use App\Models\MenuAccess;
use App\Models\MenuAccessRole;
use App\Models\Post;
use App\Models\QuickWin;
use App\Models\Regulasi;
use App\Models\SubMenu;
use App\Models\User;
use App\Models\Widget;
use Illuminate\Support\Facades\DB;

class SiteHelpers
{
    public static function themes()
    {
        $themes = DB::table('themes')
            ->where('id', 1)
            ->first();

        return $themes;
    }

    public static function seo_setting()
    {
        $seo = DB::table('general_settings')
            ->where('id', 1)
            ->first();

        return $seo;
    }

    public static function social_login()
    {
        $socialLogin = DB::table('social_logins')
            ->where('id', 1)
            ->first();

        return $socialLogin;
    }

    public static function categories()
    {
        return Categorie::all();
    }

    public static function populer_post()
    {
        return Post::orderBy('views', 'desc')->skip(0)->take(3)->get();
    }

    public static function menu()
    {
        $menu = Menu::all();
        return $menu;
    }

    public static function submenu($menu_id)
    {
        $access = SubMenu::where('menu_id', $menu_id)->where('is_active', '1')->get();
        return $access;
    }

    public static function access_menu($menu_id, $role_id)
    {
        $access = MenuAccessRole::where('menu_id', $menu_id)->where('role_id', $role_id)->where('access', '1')->first();
        return $access;
    }

    public static function access_submenu($submenu_id, $role_id)
    {
        $submenu = MenuAccessRole::where('submenu_id', $submenu_id)->where('role_id', $role_id)->where('access', '1')->first();
        return $submenu;
    }

    public static function access_menuitem($menuitem_id, $role_id)
    {
        $menuitem = MenuAccessRole::where('menuitem_id', $menuitem_id)->where('role_id', $role_id)->where('access', '1')->first();
        return $menuitem;
    }

    public static function user($role_id)
    {
        $role = User::where('role_id', $role_id)->first();
        return $role;
    }


    public static function role_access($role_id)
    {
        $menu_access = MenuAccessRole::where('role_id', $role_id)->get();
        return $menu_access;
    }

    public static function quick_win()
    {
        return QuickWin::all();
    }

    public static function document()
    {
        return Document::all();
    }

    public static function regulasi()
    {
        return Regulasi::all();
    }

    public static function widget()
    {
        return Widget::get();
    }

    function getBeritaBaru()
    {
        return Post::skip(0)->take(4)->orderBy('id', 'desc')->get();
    }
}
