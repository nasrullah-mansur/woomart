<?php

namespace Database\Seeders;

use App\Models\GeneralSettings;
use Illuminate\Database\Seeder;

class GeneralSettingsTablSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GeneralSettings::create(['slug' => 'title', 'value' => 'Welcome To woomart']);
        GeneralSettings::create(['slug' => 'company_name', 'value' => 'woomart']);
        GeneralSettings::create(['slug' => 'logo', 'value' => '']);
        GeneralSettings::create(['slug' => 'fav_icon', 'value' => '']);
        GeneralSettings::create(['slug' => 'meta_keywords', 'value' => 'business,corporate, creative, woocommerach, design, gallery, minimal, modern, landing page, cv, designer, freelancer, html, one page, personal, portfolio, programmer, responsive, vcard, one page']);
        GeneralSettings::create(['slug' => 'meta_author', 'value' => 'zainiklab']);
        GeneralSettings::create(['slug' => 'meta_description', 'value' => 'Woomart Responsive  HTML5 Template']);
        GeneralSettings::create(['slug' => 'currency', 'value' => '$']);
        GeneralSettings::create(['slug' => 'about_us', 'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fermentum uismod']);

        GeneralSettings::create(['slug' => 'facebook', 'value' => '']);
        GeneralSettings::create(['slug' => 'twitter', 'value' => '']);
        GeneralSettings::create(['slug' => 'linkedin', 'value' => '']);
        GeneralSettings::create(['slug' => 'pinterest', 'value' => '']);

        GeneralSettings::create(['slug' => 'category_section', 'value' => 'Top Category']);
        GeneralSettings::create(['slug' => 'first_section', 'value' => 'Featured Product']);
        GeneralSettings::create(['slug' => 'second_section', 'value' => 'Best Selling Product']);
        GeneralSettings::create(['slug' => 'third_section', 'value' => 'New Arrivals']);

        GeneralSettings::create(['slug' => 'sign_up_title', 'value' => 'Join With US']);
        GeneralSettings::create(['slug' => 'why_sign_up', 'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Augue malesuada in sit sit ultrices nibh sit.']);
        GeneralSettings::create(['slug' => 'sign_up_image', 'value' => '']);
        GeneralSettings::create(['slug' => 'agree_for', 'value' => 'Agree with Terms & Policy']);

        GeneralSettings::create(['slug' => 'sign_in_title', 'value' => 'Welcome Back']);
        GeneralSettings::create(['slug' => 'welcome_message', 'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Augue malesuada in sit sit ultrices nibh sit.']);
        GeneralSettings::create(['slug' => 'sign_in_image', 'value' => '']);
    }

}
