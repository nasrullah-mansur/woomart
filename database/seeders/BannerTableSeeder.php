<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Banner::create([
            'offer_banner1' => '1.jpg',
            'offer_banner2' => '2.jpg',
            'offer_banner3' => '3.jpg',
            'trend_banner1' => 'banner1.png',
            'trend_banner2' => 'banner2.png',
        ]);
    }
}
