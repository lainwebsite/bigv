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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->double('amount');
            $table->double('min_order')->nullable();
            $table->integer('max_quota')->nullable();
            $table->integer('max_discount')->nullable();
            $table->double('min_tier_points')->default(0);
            $table->datetime('duration_start')->nullable();
            $table->datetime('duration_end')->nullable();
            $table->tinyInteger('visible')->default(0);
            $table->tinyInteger('all_products')->default(0);
            $table->tinyInteger('voucher_type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discounts');
    }
};
