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
        $temp->name = "Shortcake";
        $temp->price = 40;
        $temp->discount = 0;
        // $temp->discount_start_date = ;
        // $temp->discount_end_date = ;
        $temp->product_id = 1;
        $temp->save();

        $temp = new ProductVariation();
        $temp->name = "Chocolate Cake";
        $temp->price = 20;
        $temp->discount = 0;
        // $temp->discount_start_date = ;
        // $temp->discount_end_date = ;
        $temp->product_id = 1;
        $temp->save();

        $temp = new ProductVariation();
        $temp->name = "Vanilla";
        $temp->price = 40;
        $temp->discount = 0;
        // $temp->discount_start_date = ;
        // $temp->discount_end_date = ;
        $temp->product_id = 2;
        $temp->save();
    }
}
