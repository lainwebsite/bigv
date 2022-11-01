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
                $temp = new Cart();
                $temp->price = 40;
                $temp->quantity = 1;
                $temp->user_id = 1;
                $temp->product_variation_id = 1;
                $temp->transaction_id = 1;
                $temp->save();

                $temp = new Cart();
                $temp->price = 20;
                $temp->quantity = 2;
                $temp->user_id = 1;
                $temp->product_variation_id = 2;
                $temp->transaction_id = 1;
                $temp->save();

                $temp = new Cart();
                $temp->price = 40;
                $temp->quantity = 1;
                $temp->user_id = 1;
                $temp->product_variation_id = 3;
                $temp->transaction_id = 1;
                $temp->save();

                $temp = new Cart();
                $temp->price = 40;
                $temp->quantity = 1;
                $temp->user_id = 1;
                $temp->product_variation_id = 1;
                $temp->transaction_id = 2;
                $temp->save();

                $temp = new Cart();
                $temp->price = 20;
                $temp->quantity = 2;
                $temp->user_id = 1;
                $temp->product_variation_id = 2;
                $temp->transaction_id = 2;
                $temp->save();

                $temp = new Cart();
                $temp->price = 40;
                $temp->quantity = 1;
                $temp->user_id = 1;
                $temp->product_variation_id = 3;
                $temp->transaction_id = 2;
                $temp->save();

                $temp = new Cart();
                $temp->price = 40;
                $temp->quantity = 1;
                $temp->user_id = 1;
                $temp->product_variation_id = 1;
                $temp->transaction_id = 3;
                $temp->save();

                $temp = new Cart();
                $temp->price = 20;
                $temp->quantity = 2;
                $temp->user_id = 1;
                $temp->product_variation_id = 2;
                $temp->transaction_id = 3;
                $temp->save();

                $temp = new Cart();
                $temp->price = 40;
                $temp->quantity = 1;
                $temp->user_id = 1;
                $temp->product_variation_id = 3;
                $temp->transaction_id = 3;
                $temp->save();

                $temp = new Cart();
                $temp->price = 40;
                $temp->quantity = 1;
                $temp->user_id = 1;
                $temp->product_variation_id = 1;
                $temp->save();

                $temp = new Cart();
                $temp->price = 20;
                $temp->quantity = 2;
                $temp->user_id = 1;
                $temp->product_variation_id = 2;
                $temp->transaction_id = 2;
                $temp->save();

                $temp = new Cart();
                $temp->price = 40;
                $temp->quantity = 1;
                $temp->user_id = 1;
                $temp->product_variation_id = 3;
                $temp->save();

                $temp = new Cart();
                $temp->price = 40;
                $temp->quantity = 1;
                $temp->user_id = 1;
                $temp->product_variation_id = 1;
                $temp->save();

                $temp = new Cart();
                $temp->price = 20;
                $temp->quantity = 2;
                $temp->user_id = 1;
                $temp->product_variation_id = 2;
                $temp->save();

                $temp = new Cart();
                $temp->price = 40;
                $temp->quantity = 1;
                $temp->user_id = 1;
                $temp->product_variation_id = 3;
                $temp->save();

                $temp = new Cart();
                $temp->price = 40;
                $temp->quantity = 1;
                $temp->user_id = 1;
                $temp->product_variation_id = 1;
                $temp->save();

                $temp = new Cart();
                $temp->price = 20;
                $temp->quantity = 2;
                $temp->user_id = 1;
                $temp->product_variation_id = 2;
                $temp->transaction_id = 1;
                $temp->save();

                $temp = new Cart();
                $temp->price = 40;
                $temp->quantity = 1;
                $temp->user_id = 1;
                $temp->product_variation_id = 3;
                $temp->transaction_id = 3;
                $temp->save();

                $temp = new Cart();
                $temp->price = 40;
                $temp->quantity = 1;
                $temp->user_id = 1;
                $temp->product_variation_id = 1;
                $temp->save();

                $temp = new Cart();
                $temp->price = 20;
                $temp->quantity = 2;
                $temp->user_id = 1;
                $temp->product_variation_id = 2;
                $temp->save();

                $temp = new Cart();
                $temp->price = 40;
                $temp->quantity = 1;
                $temp->user_id = 1;
                $temp->product_variation_id = 3;
                $temp->save();
        }
}
