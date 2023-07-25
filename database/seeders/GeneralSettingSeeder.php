<?php

namespace Database\Seeders;

use App\Models\GeneralSetting;
use Illuminate\Database\Seeder;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GeneralSetting::create([
            'author' => 'Adi Murdayani',
            'email' => 'adimurdayani@gmail.com',
            'phone' => '081343703057',
            'app_name' => 'Master aplikasi',
        ]);
    }
}
