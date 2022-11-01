<?php

namespace Database\Seeders;

use App\Models\ProductVariation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductVariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp = new ProductVariation();
        $temp->name = "novariation";
        $temp->price = "33.00";
        $temp->discount = "11.00";
        $temp->product_id = "1";
        $temp->save();

        $temp = new ProductVariation();
        $temp->name = "novariation";
        $temp->price = "2.50";
        $temp->product_id = "2";
        $temp->save();

        $temp = new ProductVariation();
        $temp->name = "novariation";
        $temp->price = "15.00";
        $temp->product_id = "3";
        $temp->save();

        $temp = new ProductVariation();
        $temp->name = "Medium";
        $temp->price = "20.90";
        $temp->product_id = "4";
        $temp->save();

        $temp = new ProductVariation();
        $temp->name = "Large";
        $temp->price = "25.90";
        $temp->product_id = "4";
        $temp->save();

        $temp = new ProductVariation();
        $temp->name = "novariation";
        $temp->price = "71.00";
        $temp->product_id = "5";
        $temp->save();
    }
}
