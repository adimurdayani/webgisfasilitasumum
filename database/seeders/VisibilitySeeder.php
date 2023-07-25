<?php

namespace Database\Seeders;

use App\Models\Visibilitie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisibilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Visibilitie::create([
            'title' => 'Add a feature',
            'description' => 'Feature'
        ]);
        Visibilitie::create([
            'title' => 'Add a slider',
            'description' => 'Slider'
        ]);
        Visibilitie::create([
            'title' => 'Add a breaking',
            'description' => 'Breaking'
        ]);
        Visibilitie::create([
            'title' => 'Add a rekomended',
            'description' => 'Rekomended'
        ]);
    }
}
