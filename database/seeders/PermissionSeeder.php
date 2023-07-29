<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moduleAppDashboard = Module::updateOrCreate(['name' => 'Page Dashboard']);
        $permissionDashboard = Permission::updateOrCreate([
            'module_id' => $moduleAppDashboard->id,
            'name' => 'Access Dashboard Pages',
            'slug' => 'app.dashboard',
        ]);
        // post
        $moduleAppPost = Module::updateOrCreate(['name' => 'Page Post']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPost->id,
            'name' => 'Create Post',
            'slug' => 'app.posts.index'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPost->id,
            'name' => 'Create Post',
            'slug' => 'app.posts.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPost->id,
            'name' => 'Edit Post',
            'slug' => 'app.posts.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPost->id,
            'name' => 'Delete Post',
            'slug' => 'app.posts.destroy'
        ]);

        // category
        $moduleAppCategory = Module::updateOrCreate(['name' => 'Page Category']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppCategory->id,
            'name' => 'Access Category',
            'slug' => 'app.categories.index'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppCategory->id,
            'name' => 'Edit Category',
            'slug' => 'app.categories.edit'
        ]);
        // sub category
        $moduleAppSubCategory = Module::updateOrCreate(['name' => 'Page Sub Category']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppSubCategory->id,
            'name' => 'Access Sub Category',
            'slug' => 'app.subcategories.index'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppSubCategory->id,
            'name' => 'Edit Sub Category',
            'slug' => 'app.subcategories.edit'
        ]);
        // visibility
        $moduleAppVisibility = Module::updateOrCreate(['name' => 'Page Visibility']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppVisibility->id,
            'name' => 'Access Visibility',
            'slug' => 'app.visibilities.index'
        ]);


        // galery
        $moduleAppGalery = Module::updateOrCreate(['name' => 'Page Galery']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppGalery->id,
            'name' => 'Access Galery',
            'slug' => 'app.galeries.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppGalery->id,
            'name' => 'Create Galery',
            'slug' => 'app.galeries.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppGalery->id,
            'name' => 'Edit Galery',
            'slug' => 'app.galeries.edit'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppGalery->id,
            'name' => 'Access Tab',
            'slug' => 'app.tabs.index'
        ]);

        // Widget
        $moduleAppWidget = Module::updateOrCreate(['name' => 'Page Widget']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppWidget->id,
            'name' => 'Access Widget',
            'slug' => 'app.widgets.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppWidget->id,
            'name' => 'Create Widget',
            'slug' => 'app.widgets.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppWidget->id,
            'name' => 'Edit Widget',
            'slug' => 'app.widgets.edit'
        ]);

        // maps
        $moduleAppMaps = Module::updateOrCreate(['name' => 'Page Maps']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppMaps->id,
            'name' => 'Access Maps',
            'slug' => 'app.maps.index'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppMaps->id,
            'name' => 'Access Regions',
            'slug' => 'app.regions.index'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppMaps->id,
            'name' => 'Access Village',
            'slug' => 'app.villages.index'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppMaps->id,
            'name' => 'Create Maps',
            'slug' => 'app.maps.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppMaps->id,
            'name' => 'Edit Maps',
            'slug' => 'app.maps.edit'
        ]);

        $moduleAppCoordinate = Module::updateOrCreate(['name' => 'Page Coordinate']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppCoordinate->id,
            'name' => 'Access Coordinate',
            'slug' => 'app.coordinates.index'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppCoordinate->id,
            'name' => 'Create Coordinate',
            'slug' => 'app.coordinates.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppCoordinate->id,
            'name' => 'Edit Coordinate',
            'slug' => 'app.coordinates.edit'
        ]);

        $moduleAppEducation = Module::updateOrCreate(['name' => 'Page Education']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppEducation->id,
            'name' => 'Access Education',
            'slug' => 'app.educations.index'
        ]);

        // Role
        $moduleAppRole = Module::updateOrCreate(['name' => 'Page Role Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Access Role Page',
            'slug' => 'app.roles.index'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Access Sitemap Role',
            'slug' => 'app.roles.sitemap'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Create Role',
            'slug' => 'app.roles.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Update Role',
            'slug' => 'app.roles.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Delete Role',
            'slug' => 'app.roles.destroy'
        ]);

        // Permission
        $moduleAppPermission = Module::updateOrCreate(['name' => 'Page Permission Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPermission->id,
            'name' => 'Access Permission Pages',
            'slug' => 'app.permissions.index'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPermission->id,
            'name' => 'Access Permission Menu Pages',
            'slug' => 'app.permissionmenus.index'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPermission->id,
            'name' => 'Access Modules Pages',
            'slug' => 'app.modules.index'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPermission->id,
            'name' => 'Access Permission Sub Menu Pages',
            'slug' => 'app.permissionsubmenus.index'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPermission->id,
            'name' => 'Access Permission Menu Item Pages',
            'slug' => 'app.permissionmenuitems.index'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPermission->id,
            'name' => 'Create Permission',
            'slug' => 'app.permissions.tambah-data'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPermission->id,
            'name' => 'Update Permission',
            'slug' => 'app.permissions.update-data'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPermission->id,
            'name' => 'Delete Permission',
            'slug' => 'app.permissions.hapus-data'
        ]);

        // User
        $moduleAppUser = Module::updateOrCreate(['name' => 'Page User Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Access User Pages',
            'slug' => 'app.users.index'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Create User',
            'slug' => 'app.users.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Update User',
            'slug' => 'app.users.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Delete User',
            'slug' => 'app.users.destroy'
        ]);

        // Config Web
        $moduleAppConfigWeb = Module::updateOrCreate(['name' => 'Page Settings']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppConfigWeb->id,
            'name' => 'Access General Setttings',
            'slug' => 'app.settings.index'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppConfigWeb->id,
            'name' => 'Access Company Setttings',
            'slug' => 'app.settings.company-setting'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppConfigWeb->id,
            'name' => 'Access Social Setttings',
            'slug' => 'app.settings.social-setting'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppConfigWeb->id,
            'name' => 'Access reCaptcha Setttings',
            'slug' => 'app.settings.recaptcha-setting'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppConfigWeb->id,
            'name' => 'Access Social Login Setting',
            'slug' => 'app.settings.social-login-setting'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppConfigWeb->id,
            'name' => 'Access Language Setting',
            'slug' => 'app.languages.index'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppConfigWeb->id,
            'name' => 'Create Country',
            'slug' => 'app.countries.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppConfigWeb->id,
            'name' => 'Edit Country',
            'slug' => 'app.countries.edit'
        ]);

        // Mail setting
        Permission::updateOrCreate([
            'module_id' => $moduleAppWidget->id,
            'name' => 'Access Mail Setting',
            'slug' => 'app.mails.index'
        ]);

        // SEO Setting
        $moduleAppSeoSetting = Module::updateOrCreate(['name' => 'Page SEO Website']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppSeoSetting->id,
            'name' => 'Access SEO Setttings',
            'slug' => 'app.seo-setting.index'
        ]);

        // Profile
        $moduleAppProfile = Module::updateOrCreate(['name' => 'Page Profile Account']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProfile->id,
            'name' => 'Access Profile',
            'slug' => 'app.profile.index'
        ]);

        // Themes
        $moduleAppThemes = Module::updateOrCreate(['name' => 'Page Themes']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppThemes->id,
            'name' => 'Access Themes Page',
            'slug' => 'app.theme.index'
        ]);

        // Menus
        $moduleAppMenus = Module::updateOrCreate(['name' => 'Page Menu Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppMenus->id,
            'name' => 'Access Menu Page',
            'slug' => 'app.menus.index'
        ]);
    }
}
