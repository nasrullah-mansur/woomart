<?php

namespace Database\Seeders;

use App\Models\AttributeSet;
use Illuminate\Database\Seeder;

class AttributeSetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AttributeSet::create([
            'name' => 'color',
        ]);


        AttributeSet::create([
            'name' => 'size',
        ]);
    }
}
