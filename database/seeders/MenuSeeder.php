<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuAccessRole;
use App\Models\MenuItem;
use App\Models\Role;
use App\Models\SubMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Navigation
        $menuNavigasi = Menu::updateOrCreate([
            'name' => 'Navigation',
            'slug' => 'navigation',
            'description' => 'Navigasi menu',
        ]);

        $submenudashboard = SubMenu::updateOrCreate([
            'menu_id' => $menuNavigasi->id,
            'title' => 'Dashboard',
            'url' => '/app/dashboard',
            'icon' => 'mdi mdi-view-dashboard-outline',
            'target' => '_selft',
            'order' => '1',
            'collapse' => '',
        ]);

        $role = Role::where('id', '1')->first();
        MenuAccessRole::create(
            [
                'menu_id' => $menuNavigasi->id,
                'submenu_id' => $submenudashboard->id,
                'role_id' => $role->id,
            ]
        );

        // Apps
        $app = Menu::create([
            'name' => 'Apps',
            'slug' => 'application',
            'description' => 'Aplication menu',
        ]);

        // Post
        $submenupost = SubMenu::updateOrCreate([
            'menu_id' => $app->id,
            'title' => 'Post',
            'url' => 'post',
            'icon' => 'mdi mdi-newspaper',
            'target' => '_selft',
            'order' => '1',
            'collapse' => 'collapse',
        ]);

        $role = Role::where('id', '1')->first();
        MenuAccessRole::create(
            [
                'menu_id' => $app->id,
                'submenu_id' => $submenupost->id,
                'role_id' => $role->id,
            ]
        );

        $menuItemPostArticle = MenuItem::updateOrCreate([
            'menu_id' => $app->id,
            'submenu_id' => $submenupost->id,
            'order' => '1',
            'title' => 'Create Article',
            'url' => '/app/post/article-create',
        ]);

        $role = Role::where('id', '1')->first();
        MenuAccessRole::create(
            [
                'menu_id' => $app->id,
                'submenu_id' => $submenupost->id,
                'menuitem_id' => $menuItemPostArticle->id,
                'role_id' => $role->id,
            ]
        );

        $menuItemPostlist = MenuItem::updateOrCreate([
            'menu_id' => $app->id,
            'submenu_id' => $submenupost->id,
            'order' => '3',
            'title' => 'List Post',
            'url' => '/app/post-list',
        ]);

        $role = Role::where('id', '1')->first();
        MenuAccessRole::create(
            [
                'menu_id' => $app->id,
                'submenu_id' => $submenupost->id,
                'menuitem_id' => $menuItemPostlist->id,
                'role_id' => $role->id,
            ]
        );

        $menuItemPostCategory = MenuItem::updateOrCreate([
            'menu_id' => $app->id,
            'submenu_id' => $submenupost->id,
            'order' => '4',
            'title' => 'Category',
            'url' => '/app/categories',
        ]);

        $role = Role::where('id', '1')->first();
        MenuAccessRole::create(
            [
                'menu_id' => $app->id,
                'submenu_id' => $submenupost->id,
                'menuitem_id' => $menuItemPostCategory->id,
                'role_id' => $role->id,
            ]
        );

        $menuItemPostSubCategory = MenuItem::updateOrCreate([
            'menu_id' => $role->id,
            'submenu_id' => $submenupost->id,
            'order' => '5',
            'title' => 'Sub Category',
            'url' => '/app/sub-categories',
        ]);

        $role = Role::where('id', '1')->first();
        MenuAccessRole::create(
            [
                'menu_id' => $app->id,
                'submenu_id' => $submenupost->id,
                'menuitem_id' => $menuItemPostSubCategory->id,
                'role_id' => $role->id,
            ]
        );

        $menuItemPostVisibility = MenuItem::updateOrCreate([
            'menu_id' => $role->id,
            'submenu_id' => $submenupost->id,
            'order' => '6',
            'title' => 'Visibility',
            'url' => '/app/visibility',
        ]);

        $role = Role::where('id', '1')->first();
        MenuAccessRole::create(
            [
                'menu_id' => $app->id,
                'submenu_id' => $submenupost->id,
                'menuitem_id' => $menuItemPostVisibility->id,
                'role_id' => $role->id,
            ]
        );

        // Galery
        $submenugalery = SubMenu::updateOrCreate([
            'menu_id' => $app->id,
            'title' => 'Galery',
            'url' => 'galery',
            'icon' => 'mdi mdi-image',
            'target' => '_selft',
            'order' => '2',
            'collapse' => 'collapse',
        ]);

        $menuItemImage = MenuItem::updateOrCreate([
            'menu_id' => $app->id,
            'submenu_id' => $submenugalery->id,
            'order' => '1',
            'title' => 'Image',
            'url' => '/app/galery',
        ]);

        $role = Role::where('id', '1')->first();
        MenuAccessRole::create(
            [
                'menu_id' => $app->id,
                'submenu_id' => $submenugalery->id,
                'menuitem_id' => $menuItemImage->id,
                'role_id' => $role->id,
            ]
        );

        $menuItemTabs = MenuItem::updateOrCreate([
            'menu_id' => $app->id,
            'submenu_id' => $submenugalery->id,
            'order' => '2',
            'title' => 'Tabs',
            'url' => '/app/tabs',
        ]);

        $role = Role::where('id', '1')->first();
        MenuAccessRole::create(
            [
                'menu_id' => $app->id,
                'submenu_id' => $submenugalery->id,
                'menuitem_id' => $menuItemTabs->id,
                'role_id' => $role->id,
            ]
        );

        // Widget
        $submenuWidget = SubMenu::updateOrCreate([
            'menu_id' => $app->id,
            'title' => 'Widgets',
            'url' => '/app/widget',
            'icon' => 'mdi mdi-widgets',
            'target' => '_selft',
            'order' => '3',
            'collapse' => '',
        ]);

        $role = Role::where('id', '1')->first();
        MenuAccessRole::create(
            [
                'menu_id' => $app->id,
                'submenu_id' => $submenuWidget->id,
                'role_id' => $role->id,
            ]
        );

        $role = Role::where('id', '1')->first();
        MenuAccessRole::create(
            [
                'menu_id' => $app->id,
                'submenu_id' => $submenuWidget->id,
                'role_id' => $role->id,
            ]
        );

        // Maps
        $submenuMaps = SubMenu::updateOrCreate([
            'menu_id' => $app->id,
            'title' => 'Maps',
            'url' => 'maps',
            'icon' => 'mdi mdi-map',
            'target' => '_selft',
            'order' => '5',
            'collapse' => 'collapse',
        ]);

        $menuItemCreateMap = MenuItem::updateOrCreate([
            'menu_id' => $app->id,
            'submenu_id' => $submenuMaps->id,
            'order' => '1',
            'title' => 'Create Map',
            'url' => '/app/map-list/create',
        ]);

        $role = Role::where('id', '1')->first();
        MenuAccessRole::create(
            [
                'menu_id' => $app->id,
                'submenu_id' => $submenuMaps->id,
                'menuitem_id' => $menuItemCreateMap->id,
                'role_id' => $role->id,
            ]
        );

        $menuItemCreateCoordinate = MenuItem::updateOrCreate([
            'menu_id' => $app->id,
            'submenu_id' => $submenuMaps->id,
            'order' => '2',
            'title' => 'Create Coordinate',
            'url' => '/app/coordinate/create',
        ]);

        $role = Role::where('id', '1')->first();
        MenuAccessRole::create(
            [
                'menu_id' => $app->id,
                'submenu_id' => $submenuMaps->id,
                'menuitem_id' => $menuItemCreateCoordinate->id,
                'role_id' => $role->id,
            ]
        );

        $menuItemListMap = MenuItem::updateOrCreate([
            'menu_id' => $app->id,
            'submenu_id' => $submenuMaps->id,
            'order' => '3',
            'title' => 'List Map',
            'url' => '/app/map-list',
        ]);

        $role = Role::where('id', '1')->first();
        MenuAccessRole::create(
            [
                'menu_id' => $app->id,
                'submenu_id' => $submenuMaps->id,
                'menuitem_id' => $menuItemListMap->id,
                'role_id' => $role->id,
            ]
        );

        $menuItemListCoordinate = MenuItem::updateOrCreate([
            'menu_id' => $app->id,
            'submenu_id' => $submenuMaps->id,
            'order' => '4',
            'title' => 'List Coordinate',
            'url' => '/app/coordinate',
        ]);

        $role = Role::where('id', '1')->first();
        MenuAccessRole::create(
            [
                'menu_id' => $app->id,
                'submenu_id' => $submenuMaps->id,
                'menuitem_id' => $menuItemListCoordinate->id,
                'role_id' => $role->id,
            ]
        );

        $menuItemRegion = MenuItem::updateOrCreate([
            'menu_id' => $app->id,
            'submenu_id' => $submenuMaps->id,
            'order' => '5',
            'title' => 'Regions',
            'url' => '/app/map/region',
        ]);

        $role = Role::where('id', '1')->first();
        MenuAccessRole::create(
            [
                'menu_id' => $app->id,
                'submenu_id' => $submenuMaps->id,
                'menuitem_id' => $menuItemRegion->id,
                'role_id' => $role->id,
            ]
        );

        $menuItemEducation = MenuItem::updateOrCreate([
            'menu_id' => $app->id,
            'submenu_id' => $submenuMaps->id,
            'order' => '6',
            'title' => 'Education',
            'url' => '/app/education',
        ]);

        $role = Role::where('id', '1')->first();
        MenuAccessRole::create(
            [
                'menu_id' => $app->id,
                'submenu_id' => $submenuMaps->id,
                'menuitem_id' => $menuItemEducation->id,
                'role_id' => $role->id,
            ]
        );

        // Access Control
        $MenuAccessRoleControls = Menu::create([
            'name' => 'Access Controls',
            'slug' => 'access-control',
            'description' => 'Access Control Menu',
        ]);


        $submenuModule = SubMenu::updateOrCreate([
            'menu_id' => $MenuAccessRoleControls->id,
            'title' => 'Modules',
            'url' => '/app/module',
            'icon' => 'mdi mdi-database-settings',
            'target' => '_selft',
            'order' => '1',
            'collapse' => '',
        ]);

        $role = Role::where('id', '1')->first();
        MenuAccessRole::create(
            [
                'menu_id' => $MenuAccessRoleControls->id,
                'submenu_id' => $submenuModule->id,
                'role_id' => $role->id,
            ]
        );

        $submenupermission = SubMenu::updateOrCreate([
            'menu_id' => $MenuAccessRoleControls->id,
            'title' => 'Permissions',
            'url' => '/app/permission',
            'icon' => 'mdi mdi-database-sync',
            'target' => '_selft',
            'order' => '2',
            'collapse' => '',
        ]);

        $role = Role::where('id', '1')->first();
        MenuAccessRole::create(
            [
                'menu_id' => $MenuAccessRoleControls->id,
                'submenu_id' => $submenupermission->id,
                'role_id' => $role->id,
            ]
        );

        $submenuUser = SubMenu::updateOrCreate([
            'menu_id' => $MenuAccessRoleControls->id,
            'title' => 'Users Management',
            'url' => 'user-management',
            'icon' => 'mdi mdi-account-group',
            'target' => '_selft',
            'order' => '3',
            'collapse' => 'collapse',
        ]);

        $menuItemRole = MenuItem::updateOrCreate([
            'menu_id' => $MenuAccessRoleControls->id,
            'submenu_id' => $submenuUser->id,
            'order' => '1',
            'title' => 'Roles',
            'url' => '/app/role',
        ]);
        $role = Role::where('id', '1')->first();
        MenuAccessRole::create(
            [
                'menu_id' => $MenuAccessRoleControls->id,
                'submenu_id' => $submenuUser->id,
                'menuitem_id' => $menuItemRole->id,
                'role_id' => $role->id,
            ]
        );

        $menuitemUser = MenuItem::updateOrCreate([
            'menu_id' => $MenuAccessRoleControls->id,
            'submenu_id' => $submenuUser->id,
            'order' => '2',
            'title' => 'Users',
            'url' => '/app/user',
        ]);

        $role = Role::where('id', '1')->first();
        MenuAccessRole::create(
            [
                'menu_id' => $MenuAccessRoleControls->id,
                'submenu_id' => $submenuUser->id,
                'menuitem_id' => $menuitemUser->id,
                'role_id' => $role->id,
            ]
        );

        // Systems
        $menuSystems = Menu::create([
            'name' => 'Systems',
            'slug' => 'systems',
            'description' => 'System menu',
        ]);

        // Menu Management
        $submenuManagement = SubMenu::updateOrCreate([
            'menu_id' => $menuSystems->id,
            'title' => 'Menu Management',
            'url' => 'menu-management',
            'icon' => 'fe-menu',
            'target' => '_selft',
            'order' => '1',
            'collapse' => 'collapse',
        ]);

        $menuItemBackend = MenuItem::updateOrCreate([
            'menu_id' => $menuSystems->id,
            'submenu_id' => $submenuManagement->id,
            'order' => '1',
            'title' => 'Backend Menus',
            'url' => '/app/menus',
        ]);

        $role = Role::where('id', '1')->first();
        MenuAccessRole::create(
            [
                'menu_id' => $menuSystems->id,
                'submenu_id' => $submenuManagement->id,
                'menuitem_id' => $menuItemBackend->id,
                'role_id' => $role->id,
            ]
        );

        // Settings
        $submenuSettings = SubMenu::updateOrCreate([
            'menu_id' => $menuSystems->id,
            'title' => 'Settings',
            'url' => 'setting',
            'icon' => 'fe-settings',
            'target' => '_selft',
            'order' => '2',
            'collapse' => 'collapse',
        ]);


        $menuitemGeneralSetting = MenuItem::updateOrCreate([
            'menu_id' => $menuSystems->id,
            'submenu_id' => $submenuSettings->id,
            'order' => '1',
            'title' => 'General Settings',
            'url' => '/app/setting',
        ]);

        $role = Role::where('id', '1')->first();
        MenuAccessRole::create(
            [
                'menu_id' => $menuSystems->id,
                'submenu_id' => $submenuSettings->id,
                'menuitem_id' => $menuitemGeneralSetting->id,
                'role_id' => $role->id,
            ]
        );

        $menuitemSeoSetting =  MenuItem::updateOrCreate([
            'menu_id' => $menuSystems->id,
            'submenu_id' => $submenuSettings->id,
            'order' => '2',
            'title' => 'SEO Settings',
            'url' => '/app/seo-setting',
        ]);

        $role = Role::where('id', '1')->first();
        MenuAccessRole::create(
            [
                'menu_id' => $menuSystems->id,
                'submenu_id' => $submenuSettings->id,
                'menuitem_id' => $menuitemSeoSetting->id,
                'role_id' => $role->id,
            ]
        );

        $theme =  MenuItem::updateOrCreate([
            'menu_id' => $menuSystems->id,
            'submenu_id' => $submenuSettings->id,
            'order' => '3',
            'title' => 'Themes',
            'url' => '/app/theme',
        ]);

        $role = Role::where('id', '1')->first();
        MenuAccessRole::create(
            [
                'menu_id' => $menuSystems->id,
                'submenu_id' => $submenuSettings->id,
                'menuitem_id' => $theme->id,
                'role_id' => $role->id,
            ]
        );
    }
}
