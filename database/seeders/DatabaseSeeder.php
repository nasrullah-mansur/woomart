<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(AdminTablSeeder::class);
        $this->call(GeneralSettingsTablSeeder::class);
        $this->call(BlogTableSeeder::class);
        $this->call(BannerTableSeeder::class);
        $this->call(SliderTableSeeder::class);
        $this->call(ContactUsSettingsTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(AttributeSetTableSeeder::class);
        $this->call(AttributeTableSeeder::class);
        $this->call(ColorTableSeeder::class);
        $this->call(SizeTableSeeder::class);
        $this->call(BrandTableSeeder::class);
        $this->call(AboutUsTableSeeder::class);
        $this->call(TermAndConditionTableSeeder::class);
        $this->call(Error404TableSeeder::class);
        $this->call(ShopBannerTableSeeder::class);
        $this->call(ClientFeedbackTableSeeder::class);
    }
}
