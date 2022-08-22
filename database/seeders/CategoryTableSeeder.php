<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Fashion',
            'icon' => 'c1.svg',
            'slug' =>'men-s-clothing',
            'image' =>null,
            'parent_id' =>PARENT,
            'active_status' =>true,
            'top_category' =>false,
        ]);


        Category::create([
            'name' => 'Electronics',
            'icon' => 'c3.svg',
            'slug' =>'phones-&-accessories',
            'image' =>null,
            'parent_id' =>PARENT,
            'active_status' =>true,
            'top_category' =>false,
        ]);

        Category::create([
            'name' => 'Men’s Clothing',
            'icon' => 'c1.svg',
            'slug' =>'men-s-clothing',
            'image' =>null,
            'parent_id' =>1,
            'active_status' =>true,
            'top_category' =>false,
        ]);

        Category::create([
            'name' => 'Women’s Clothing',
            'icon' => 'c2.svg',
            'slug' =>'women-s-clothing',
            'image' =>null,
            'parent_id' =>1,
            'active_status' =>true,
            'top_category' =>false,
        ]);



        Category::create([
            'name' => 'Phones & Accessories',
            'icon' => 'c3.svg',
            'slug' =>'phones-&-accessories',
            'image' =>null,
            'parent_id' =>2,
            'active_status' =>true,
            'top_category' =>false,
        ]);


        Category::create([
            'name' => 'Computer, Office Security',
            'icon' => 'c4.svg',
            'slug' =>'computer-office-security',
            'image' =>null,
            'parent_id' =>2,
            'active_status' =>true,
            'top_category' =>false,
        ]);


    }
}
