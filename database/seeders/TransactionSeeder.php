<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp = new Transaction();
        $temp->total_price = 120;
        $temp->shipping_fee = 10;
        $temp->product_discount_total = 0;
        $temp->shipping_discount_total = 0;
        $temp->delivery_date = Carbon::now();
        $temp->billing_address_id = 1;
        $temp->shipping_address_id = 1;
        $temp->payment_method_id = 1;
        $temp->pickup_method_id = 1;
        $temp->pickup_time_id = 1;
        $temp->status_id = 1;
        $temp->user_id = 1;
        $temp->save();

        $temp = new Transaction();
        $temp->total_price = 120;
        $temp->shipping_fee = 10;
        $temp->product_discount_total = 0;
        $temp->shipping_discount_total = 0;
        $temp->delivery_date = Carbon::now();
        $temp->billing_address_id = 1;
        $temp->shipping_address_id = 1;
        $temp->payment_method_id = 1;
        $temp->pickup_method_id = 1;
        $temp->pickup_time_id = 1;
        $temp->status_id = 2;
        $temp->user_id = 1;
        $temp->save();

        $temp = new Transaction();
        $temp->total_price = 120;
        $temp->shipping_fee = 10;
        $temp->product_discount_total = 0;
        $temp->shipping_discount_total = 0;
        $temp->delivery_date = Carbon::now();
        $temp->billing_address_id = 1;
        $temp->shipping_address_id = 1;
        $temp->payment_method_id = 1;
        $temp->pickup_method_id = 1;
        $temp->pickup_time_id = 1;
        $temp->status_id = 3;
        $temp->user_id = 1;
        $temp->save();

        $temp = new Transaction();
        $temp->total_price = 120;
        $temp->shipping_fee = 10;
        $temp->product_discount_total = 0;
        $temp->shipping_discount_total = 0;
        $temp->delivery_date = Carbon::now();
        $temp->billing_address_id = 1;
        $temp->shipping_address_id = 1;
        $temp->payment_method_id = 1;
        $temp->pickup_method_id = 1;
        $temp->pickup_time_id = 1;
        $temp->status_id = 4;
        $temp->user_id = 1;
        $temp->save();

        $temp = new Transaction();
        $temp->total_price = 120;
        $temp->shipping_fee = 10;
        $temp->product_discount_total = 0;
        $temp->shipping_discount_total = 0;
        $temp->delivery_date = Carbon::now();
        $temp->billing_address_id = 1;
        $temp->shipping_address_id = 1;
        $temp->payment_method_id = 1;
        $temp->pickup_method_id = 1;
        $temp->pickup_time_id = 1;
        $temp->status_id = 5;
        $temp->user_id = 1;
        $temp->save();

        $temp = new Transaction();
        $temp->total_price = 120;
        $temp->shipping_fee = 10;
        $temp->product_discount_total = 0;
        $temp->shipping_discount_total = 0;
        $temp->delivery_date = Carbon::now();
        $temp->billing_address_id = 1;
        $temp->shipping_address_id = 1;
        $temp->payment_method_id = 1;
        $temp->pickup_method_id = 1;
        $temp->pickup_time_id = 1;
        $temp->status_id = 6;
        $temp->user_id = 1;
        $temp->save();

        $temp = new Transaction();
        $temp->total_price = 120;
        $temp->shipping_fee = 10;
        $temp->product_discount_total = 0;
        $temp->shipping_discount_total = 0;
        $temp->delivery_date = Carbon::now();
        $temp->billing_address_id = 1;
        $temp->shipping_address_id = 1;
        $temp->payment_method_id = 1;
        $temp->pickup_method_id = 1;
        $temp->pickup_time_id = 1;
        $temp->status_id = 7;
        $temp->user_id = 1;
        $temp->save();
    }
}
