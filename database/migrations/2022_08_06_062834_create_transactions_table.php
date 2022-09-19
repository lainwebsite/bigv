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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->double('total_price');
            $table->double('shipping_fee');
            $table->double('product_discount_total')->default(0);
            $table->double('shipping_discount_total')->default(0);
            $table->date('delivery_date');
            $table->unsignedBigInteger('billing_address_id')->index()->nullable();
            $table->foreign('billing_address_id')->references('id')->on('user_addresses')->onDelete('cascade');
            $table->unsignedBigInteger('shipping_address_id')->index()->nullable();
            $table->foreign('shipping_address_id')->references('id')->on('user_addresses')->onDelete('cascade');
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
        Schema::dropIfExists('transactions');
    }
};
