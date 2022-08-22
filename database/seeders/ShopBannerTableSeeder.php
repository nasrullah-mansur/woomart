<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Seeder;

class ShopBannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shop::create([
            'banner' => 'banner1.png',
            'active_status' => STATUS_ACTIVE,
        ]);

        Shop::create([
            'banner' => 'banner2.png',
            'active_status' => STATUS_ACTIVE,
        ]);
    }
}
