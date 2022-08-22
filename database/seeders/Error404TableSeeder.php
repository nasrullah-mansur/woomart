<?php

namespace Database\Seeders;

use App\Models\Error404;
use Illuminate\Database\Seeder;

class Error404TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Error404::create([
            'image' => '404.png'
        ]);
    }
}
