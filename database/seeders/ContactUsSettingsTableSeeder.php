<?php

namespace Database\Seeders;

use App\Models\ContactUsSetting;
use Illuminate\Database\Seeder;

class ContactUsSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactUsSetting::create([
            'address' => '354 King Street, Melbourne Victoria 5467 Australia',
            'phone' => '(0321) 645-798-021',
            'email' => 'info@mail.com',
            'site_url' => 'yoursite.com',
        ]);
    }
}
