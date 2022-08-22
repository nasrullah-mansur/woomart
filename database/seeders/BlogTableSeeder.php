<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Blog::create([
            'title' => 'Feugiat cursus maecenas magna quam ut varius nibh mauris. Cursus lectus quam erat fringilla. ',
            'slug' => time() . '-' . Str::slug('Feugiat cursus maecenas magna quam', '-'),
            'description' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Arcu cursus lorem a dictum duis pharetra tempor ultrices enim. Id cras sit est maecenas risus cursus. Aliquet phasellus est mauris porta semper semper. In ultricies pharetra, aliquam elit dignissim enim donec est, laoreet. Viverra lacinia proin est, ultricies fringilla fringilla et. Pulvinar nulla tristique lacus cras diam quis est. Tortor pulvinar hendrerit imperdiet pulvinar augue neque congue. Blandit montes, eu adipiscing rhoncus nec sed non volutpat tellus. Bibendum viverra amet porta vulputate id nibh sodales pulvinar habitasse.

Commodo ante imperdiet quis lacus aenean lacinia nisl. Metus, rhoncus fermentum diam vitae laoreet amet. Suspendisse sem sit molestie aliquam eu amet. At blandit neque.

Pulvinar nulla tristique lacus cras diam quis est. Tortor pulvinar hendrerit imperdiet pulvinar augue neque congue. Blandit montes, eu adipiscing rhoncus nec sed non volutpat tellus. Bibendum viverra amet porta vulputate id nibh sodales pulvinar habitasse.",
            'quotation' => "Commodo ante imperdiet quis lacus aenean lacinia nisl. Metus, rhoncus fermentum diam vitae laoreet amet. Suspendisse sem sit molestie aliquam eu amet. At blandit neque.",
            'popular' => false,
            'active_status' => true,
            'image' => '1.jpg'
        ]);


        Blog::create([
            'title' => 'Feugiat cursus maecenas magna quam ut varius nibh mauris. Cursus lectus quam erat fringilla. ',
            'slug' => time() . '-' . Str::slug('Feugiat cursus maecenas magna quam', '-'),
            'description' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Arcu cursus lorem a dictum duis pharetra tempor ultrices enim. Id cras sit est maecenas risus cursus. Aliquet phasellus est mauris porta semper semper. In ultricies pharetra, aliquam elit dignissim enim donec est, laoreet. Viverra lacinia proin est, ultricies fringilla fringilla et. Pulvinar nulla tristique lacus cras diam quis est. Tortor pulvinar hendrerit imperdiet pulvinar augue neque congue. Blandit montes, eu adipiscing rhoncus nec sed non volutpat tellus. Bibendum viverra amet porta vulputate id nibh sodales pulvinar habitasse.

Commodo ante imperdiet quis lacus aenean lacinia nisl. Metus, rhoncus fermentum diam vitae laoreet amet. Suspendisse sem sit molestie aliquam eu amet. At blandit neque.

Pulvinar nulla tristique lacus cras diam quis est. Tortor pulvinar hendrerit imperdiet pulvinar augue neque congue. Blandit montes, eu adipiscing rhoncus nec sed non volutpat tellus. Bibendum viverra amet porta vulputate id nibh sodales pulvinar habitasse.",
            'quotation' => "Commodo ante imperdiet quis lacus aenean lacinia nisl. Metus, rhoncus fermentum diam vitae laoreet amet. Suspendisse sem sit molestie aliquam eu amet. At blandit neque.",
            'popular' => true,
            'active_status' => true,
            'image' => '1.jpg'
        ]);

        Blog::create([
            'title' => 'Feugiat cursus maecenas magna quam ut varius nibh mauris. Cursus lectus quam erat fringilla. ',
            'slug' => time().'-'.Str::slug('Feugiat cursus maecenas magna quam','-'),
            'description' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Arcu cursus lorem a dictum duis pharetra tempor ultrices enim. Id cras sit est maecenas risus cursus. Aliquet phasellus est mauris porta semper semper. In ultricies pharetra, aliquam elit dignissim enim donec est, laoreet. Viverra lacinia proin est, ultricies fringilla fringilla et. Pulvinar nulla tristique lacus cras diam quis est. Tortor pulvinar hendrerit imperdiet pulvinar augue neque congue. Blandit montes, eu adipiscing rhoncus nec sed non volutpat tellus. Bibendum viverra amet porta vulputate id nibh sodales pulvinar habitasse.

Commodo ante imperdiet quis lacus aenean lacinia nisl. Metus, rhoncus fermentum diam vitae laoreet amet. Suspendisse sem sit molestie aliquam eu amet. At blandit neque.

Pulvinar nulla tristique lacus cras diam quis est. Tortor pulvinar hendrerit imperdiet pulvinar augue neque congue. Blandit montes, eu adipiscing rhoncus nec sed non volutpat tellus. Bibendum viverra amet porta vulputate id nibh sodales pulvinar habitasse.",
            'quotation' => "Commodo ante imperdiet quis lacus aenean lacinia nisl. Metus, rhoncus fermentum diam vitae laoreet amet. Suspendisse sem sit molestie aliquam eu amet. At blandit neque.",
            'popular' => false,
            'active_status' => true,
            'image' => '2.jpg'
        ]);

        Blog::create([
            'title' => 'Feugiat cursus maecenas magna quam ut varius nibh mauris. Cursus lectus quam erat fringilla. ',
            'slug' => time().'-'.Str::slug('Feugiat cursus maecenas magna quam','-'),
            'description' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Arcu cursus lorem a dictum duis pharetra tempor ultrices enim. Id cras sit est maecenas risus cursus. Aliquet phasellus est mauris porta semper semper. In ultricies pharetra, aliquam elit dignissim enim donec est, laoreet. Viverra lacinia proin est, ultricies fringilla fringilla et. Pulvinar nulla tristique lacus cras diam quis est. Tortor pulvinar hendrerit imperdiet pulvinar augue neque congue. Blandit montes, eu adipiscing rhoncus nec sed non volutpat tellus. Bibendum viverra amet porta vulputate id nibh sodales pulvinar habitasse.

Commodo ante imperdiet quis lacus aenean lacinia nisl. Metus, rhoncus fermentum diam vitae laoreet amet. Suspendisse sem sit molestie aliquam eu amet. At blandit neque.

Pulvinar nulla tristique lacus cras diam quis est. Tortor pulvinar hendrerit imperdiet pulvinar augue neque congue. Blandit montes, eu adipiscing rhoncus nec sed non volutpat tellus. Bibendum viverra amet porta vulputate id nibh sodales pulvinar habitasse.",
            'quotation' => "Commodo ante imperdiet quis lacus aenean lacinia nisl. Metus, rhoncus fermentum diam vitae laoreet amet. Suspendisse sem sit molestie aliquam eu amet. At blandit neque.",
            'popular' => true,
            'active_status' => true,
            'image' => '3.jpg'
        ]);

    }
}
