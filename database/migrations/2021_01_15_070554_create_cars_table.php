<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('image_url')->nullable();
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('model_id');
            $table->date('year_of_manufacture');
            $table->string('number')->unique();
            $table->string('color')->nullable();
            $table->enum('transmission', ['auto', 'manual'])->default('manual');
            $table->double('price_per_day');
            $table->timestamps();
            $table->foreign('brand_id')->references('id')->on('car_brands')
                ->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('model_id')->references('id')->on('car_models')
                ->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
