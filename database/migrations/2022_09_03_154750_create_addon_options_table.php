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
        Schema::create('addon_options', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('price');
            $table->unsignedBigInteger('addon_id')->index();
            $table->foreign('addon_id')->references('id')->on('addons')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('addon_options');
    }
};
