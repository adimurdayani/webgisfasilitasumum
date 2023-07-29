<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            'name' => 'English',
            'code' => 'en',
            'status' => 1,
            'flag' => 'us',
        ]);
        Language::create([
            'name' => 'Indonesia',
            'code' => 'id',
            'status' => 0,
            'flag' => 'id',
        ]);
    }
}
