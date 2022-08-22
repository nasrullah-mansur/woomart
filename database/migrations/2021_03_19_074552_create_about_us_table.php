<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->text('about_us')->nullable();

            $table->string('middle_section_title')->nullable();
            $table->text('middle_section_description')->nullable();

            $table->string('middle_section_content1_icon')->nullable();
            $table->string('middle_section_content1_title')->nullable();
            $table->text('middle_section_content1_description')->nullable();

            $table->string('middle_section_content2_icon')->nullable();
            $table->string('middle_section_content2_title')->nullable();
            $table->text('middle_section_content2_description')->nullable();

            $table->string('middle_section_content3_icon')->nullable();
            $table->string('middle_section_content3_title')->nullable();
            $table->text('middle_section_content3_description')->nullable();


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
        Schema::dropIfExists('about_us');
    }
}
