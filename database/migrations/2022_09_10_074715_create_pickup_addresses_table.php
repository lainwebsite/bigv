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
        Schema::create('pickup_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('additional_info')->nullable();
            $table->integer('block_number')->nullable();
            $table->string('street')->nullable();
            $table->integer('unit_level')->nullable();
            $table->integer('unit_number')->nullable();
            $table->string('building_name')->nullable();
            $table->string('postal_code');
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
        Schema::dropIfExists('pickup_addresses');
    }
};
