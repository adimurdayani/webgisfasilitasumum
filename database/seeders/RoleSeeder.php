<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $adminPermissions = Permission::all();

        $role = Role::updateOrCreate([
            'name' => 'Super Admin',
            'slug' => Str::slug('super admin'),
            'deletable' => false
        ]);

        $role->permissions()->sync($adminPermissions->pluck('id'));



        Role::updateOrCreate([
            'name' => 'Admin',
            'slug' => 'admin',
            'deletable' => false
        ]);

        Role::updateOrCreate([
            'name' => 'User',
            'slug' => 'user',
            'deletable' => false
        ]);
    }
}
