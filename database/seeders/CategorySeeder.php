<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\SubCategorie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categorie::create([
            'title' => 'World',
            'slug' => 'world',
            'description' => 'world',
            'keywords' => 'world',
        ]);

        Categorie::create([
            'title' => 'Science',
            'slug' => 'science',
            'description' => 'Science',
            'keywords' => 'Science',
        ]);

        $categoryLifestyle = Categorie::create([
            'title' => 'Life Style',
            'slug' => 'life-style',
            'description' => 'life style',
            'keywords' => 'life style',
        ]);

        SubCategorie::create([
            'categorie_id' => $categoryLifestyle->id,
            'title' => 'Life Style',
            'slug' => 'life-style',
            'description' => 'life style',
            'keywords' => 'life style',
        ]);
    }
}
