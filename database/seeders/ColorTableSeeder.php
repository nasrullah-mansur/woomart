<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::create([
            'name' => 'Red',
            'color_code' => '#FF0000',
        ]);

        Color::create([
            'name' => 'Black',
            'color_code' => '#000000',
        ]);

        Color::create([
            'name' => 'Gray',
            'color_code' => '#808080',
        ]);


        Color::create([
            'name' => 'Silver',
            'color_code' => '#C0C0C0',
        ]);


    }
}
