<?php

namespace Database\Seeders;

use App\Models\ProductCategoryDiscount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategoryDiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp = new ProductCategoryDiscount();
        $temp->name = "Merdeka Discount 30%";
        $temp->code = "a";
        $temp->amount = "5";
        $temp->min_tier_points = "21";
        $temp->duration_start = "2022-08-18 10:12:37";
        $temp->duration_end = "2022-09-18 10:12:37";
        $temp->type_id = "3";
        $temp->discount_applicable_id = "2";
        $temp->save();
    }
}
