<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create([
            'name' => 'reverland',
            'slug' => time() . '-' . 'reverland',
            'image' => '1.png',
            'active_status' => true
        ]);

        Brand::create([
            'name' => 'liva',
            'slug' => time() . '-' . 'liva',
            'image' => '2.png',
            'active_status' => true
        ]);

        Brand::create([

            'name' => 'pure',
            'slug' => time() . '-' . 'pure',

            'image' => '3.png',
            'active_status' => true
        ]);

        Brand::create([
            'name' => 'hexlab',
            'slug' => time() . '-' . 'hexlab',

            'image' => '4.png',
            'active_status' => true
        ]);

        Brand::create([
            'name' => 'copixel',
            'slug' => time() . '-' . 'copixel',
            'image' => '5.png',
            'active_status' => true
        ]);

    }
}
