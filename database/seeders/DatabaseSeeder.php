<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(VisibilitySeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(GeneralSettingSeeder::class);
        $this->call(ThemesSeeder::class);
        $this->call(SocialLoginSeeder::class);
        $this->call(MailSettingSeeder::class);
        $this->call(WidgetSeeder::class);
        $this->call(LanguageSeeder::class);
    }
}
