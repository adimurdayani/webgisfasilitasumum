<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThemesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Theme::create([
            'mode' => 'light',
            'width' => 'fluid',
            'menu_position' => 'fixed',
            'sidebar_color' => 'light',
            'sidebar_size' => 'default',
            'sidebar_showuser' => 'false',
            'topbar_color' => 'dark',
        ]);
    }
}
