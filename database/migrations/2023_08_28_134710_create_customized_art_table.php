<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomizedArtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customized__art', function (Blueprint $table) {
            $table->id();
            $table->integer('frame_id')->nullable();
            $table->integer('order_id')->nullable();
            $table->integer('picture_id')->nullable();
            $table->float('width');
            $table->float('height');
            $table->float('background_size');
            $table->decimal('price',10,2);
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
        Schema::dropIfExists('customized_art');
    }
}
