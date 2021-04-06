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
            $table->string('name');
            $table->integer('service');
            $table->integer('vendor_id');
            $table->text('description')->nullable();
            $table->string('image');
            $table->float('price');
            $table->string('delivery_times')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->float('rating')->nullable();
            $table->string('deals');
            $table->integer('delivery_options')->nullable();
            $table->rememberToken();
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
