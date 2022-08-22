<?php

namespace Database\Seeders;

use App\Models\ClientFeedback;
use Illuminate\Database\Seeder;

class ClientFeedbackTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClientFeedback::create([
            'name' => 'Catrina Kaif',
            'profession' => 'Actress',
            'image' => 'testimonial-big.png',
            'feedback' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Risus volutpat arcu purus tristique. Nunc a, nec sed odio pretium praesent erat. Viverra magna neque, morbi libero, purus, nisl lectus eu tincidunt. Viverra orci et donec tincidunt nec gravida elementum ultricies laoreet. Convallis netus sagittis. Viverra magna neque, morbi libero, purus, nisl lectus Viverra magna neque, morbi libero, Viverra',
            'active_status' => true,
        ]);

        ClientFeedback::create([
            'name' => 'Catrina Kaif',
            'profession' => 'Actress',
            'image' => 'testimonial-big1.png',
            'feedback' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Risus volutpat arcu purus tristique. Nunc a, nec sed odio pretium praesent erat. Viverra magna neque, morbi libero, purus, nisl lectus eu tincidunt. Viverra orci et donec tincidunt nec gravida elementum ultricies laoreet. Convallis netus sagittis. Viverra magna neque, morbi libero, purus, nisl lectus Viverra magna neque, morbi libero, Viverra',
            'active_status' => true,
        ]);

        ClientFeedback::create([
            'name' => 'Catrina Kaif',
            'profession' => 'Actress',
            'image' => 'testimonial-big2.png',
            'feedback' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Risus volutpat arcu purus tristique. Nunc a, nec sed odio pretium praesent erat. Viverra magna neque, morbi libero, purus, nisl lectus eu tincidunt. Viverra orci et donec tincidunt nec gravida elementum ultricies laoreet. Convallis netus sagittis. Viverra magna neque, morbi libero, purus, nisl lectus Viverra magna neque, morbi libero, Viverra',
            'active_status' => true,
        ]);
    }
}
