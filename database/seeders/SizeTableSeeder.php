<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Size::create([

            'size' => 'S',
            'chest' => '56',
            'shoulder' => '36',
            'length' => '45',
            'sleeve' => '60',
        ]);

        Size::create([

            'size' => 'M',
            'chest' => '56',
            'shoulder' => '36',
            'length' => '45',
            'sleeve' => '60',
        ]);


        Size::create([

            'size' => 'L',
            'chest' => '56',
            'shoulder' => '36',
            'length' => '45',
            'sleeve' => '60',
        ]);


        Size::create([

            'size' => 'XL',
            'chest' => '56',
            'shoulder' => '36',
            'length' => '45',
            'sleeve' => '60',
        ]);


        Size::create([

            'size' => 'XXL',
            'chest' => '56',
            'shoulder' => '36',
            'length' => '45',
            'sleeve' => '60',
        ]);

    }
}
