<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Transaction 1
        $temp = new Cart();
        $temp->price = "22";
        $temp->quantity = "3";
        $temp->user_id = "1";
        $temp->product_variation_id = "1";
        $temp->transaction_id = "1";
        $temp->save();

        $temp = new Cart();
        $temp->price = "2.5";
        $temp->quantity = "2";
        $temp->user_id = "1";
        $temp->product_variation_id = "2";
        $temp->transaction_id = "1";
        $temp->save();

        // Transaction 2
        $temp = new Cart();
        $temp->price = "22";
        $temp->quantity = "4";
        $temp->user_id = "1";
        $temp->product_variation_id = "1";
        $temp->transaction_id = "2";
        $temp->save();

        // No transaction
        $temp = new Cart();
        $temp->price = "22";
        $temp->quantity = "1";
        $temp->user_id = "1";
        $temp->product_variation_id = "1";
        $temp->save();

        $temp = new Cart();
        $temp->price = "15";
        $temp->quantity = "2";
        $temp->user_id = "1";
        $temp->product_variation_id = "3";
        $temp->save();

        $temp = new Cart();
        $temp->price = "2.5";
        $temp->quantity = "10";
        $temp->user_id = "1";
        $temp->product_variation_id = "2";
        $temp->save();
    }
}
