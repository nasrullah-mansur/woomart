<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slider::create([
            'title' => '',
            'image' => 'slider1.jpg',
            'active_status' => true,
        ]);

        Slider::create([
            'title' => '',
            'image' => 'slider2.jpg',
            'active_status' => true,
        ]);

        Slider::create([
            'title' => '',
            'image' => 'slider3.jpg',
            'active_status' => true,
        ]);
    }
}
