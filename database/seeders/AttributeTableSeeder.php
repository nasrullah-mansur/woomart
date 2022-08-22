<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Attribute::create([
            'attribute_set_id' => 1,
            'value' => 'Red',
            'color_code' => '#FF0000',
        ]);

        Attribute::create([
            'attribute_set_id' => 1,
            'value' => 'Black',
            'color_code' => '#000000',
        ]);

        Attribute::create([
            'attribute_set_id' => 1,
            'value' => 'Gray',
            'color_code' => '#808080',
        ]);


        Attribute::create([
            'attribute_set_id' => 1,
            'value' => 'Silver',
            'color_code' => '#C0C0C0',
        ]);

        Attribute::create([
            'attribute_set_id' => 1,
            'value' => 'Red',
            'color_code' => '#FF0000',
        ]);

        Attribute::create([
            'attribute_set_id' => 2,
            'value' => 'S',
        ]);

        Attribute::create([
            'attribute_set_id' => 2,
            'value' => 'M',
        ]);


        Attribute::create([
            'attribute_set_id' => 2,
            'value' => 'L',
        ]);


        Attribute::create([
            'attribute_set_id' => 2,
            'value' => 'XL',
        ]);

        Attribute::create([
            'attribute_set_id' => 2,
            'value' => 'XXL',
        ]);

    }
}
