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
            $table->string('title');
            $table->string('slug');
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('subService_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('price', $precision = 10, $scale = 3);
            $table->decimal('discount', $precision = 10, $scale = 3);
            $table->smallInteger('quantity');
            $table->longText('description')->nullable();
            // post images
            $table->string('menu_image_path')->nullable();
            //features or attributes
            $table->dateTime('starts_at');
            $table->dateTime('ends_at');
            $table->longText('terms_of_use')->nullable();
            $table->smallInteger('deadline_for_use');
            $table->tinyInteger('availability')->default('1');
            $table->tinyInteger('status')->default('0');
            $table->timestamps();

            $table->foreign('service_id')->references('id')->on('categories');

            $table->foreign('subService_id')->references('id')->on('categories');

            $table->foreign('user_id')->references('id')->on('users');

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
