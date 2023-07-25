<?php

namespace Database\Seeders;

use App\Models\Widget;
use Illuminate\Database\Seeder;

class WidgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Widget::create([
            'title' => 'Berita Populer',
            'location' => 'right sidebar',
            'content_type' => 'populer post',
            'order' => '1',
            'is_active' => true,
        ]);
    }
}
