<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name',191);
            $table->string('about_product')->nullable();

            $table->string('slug',191);
            $table->string('brand',191)->nullable();

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->string('sub_category_id')->nullable();

            $table->decimal('price')->default(0);
            $table->decimal('discount')->default(0);
            $table->decimal('discount_price')->default(0);
            $table->decimal('quantity')->default(0);
            $table->decimal('sold')->default(0);

            $table->text('description')->nullable();

            $table->string('primary_image');
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();

            $table->boolean('first_section')->default(false);
            $table->boolean('second_section')->default(false);
            $table->boolean('third_section')->default(false);

            $table->boolean('active_status')->default(true);
            $table->boolean('is_new')->default(true);
            $table->boolean('is_trending')->default(true);



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
