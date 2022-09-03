<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('addon_option_id')->index();
            $table->foreign('addon_option_id')->references('id')->on('addon_options')->onDelete('cascade');
            $table->unsignedBigInteger('cart_id')->index();
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
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
        Schema::dropIfExists('option_carts');
    }
};
