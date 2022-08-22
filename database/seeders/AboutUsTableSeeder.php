<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Seeder;

class AboutUsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AboutUs::create([
            'image' => 'about-image.png',
            'about_us' => ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Risus volutpat arcu purus tristique. Nunc a, nec sed odio pretium praesent erat. Viverra magna neque, morbi libero, purus, nisl lectus eu tincidunt. Viverra orci et donec tincidunt nec gravida elementum ultricies laoreet. Convallis netus sagittis.
    Viverra magna neque, morbi libero, purus, nisl lectus
    Viverra magna neque, morbi libero,
    Viverra magna neque, morbi libero, purus, nisl
    Viverra magna neque, morbi
    Viverra magna neque, morbi libero, purus, nisl lectus
',
            'middle_section_title' => 'Our Mission & Vision',
            'middle_section_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Placerat nec enim maecenas venenatis dignissim. ',

            'middle_section_content1_icon' => '',
            'middle_section_content1_title' => 'Growth Customers',
            'middle_section_content1_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et tortor et sed enim.',

            'middle_section_content2_icon' => '',
            'middle_section_content2_title' => 'Customers Satisfaction',
            'middle_section_content2_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et tortor et sed enim.',

            'middle_section_content3_icon' => '',
            'middle_section_content3_title' => 'Strategy',
            'middle_section_content3_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et tortor et sed enim.',

            ]);

    }
}
