<?php

namespace Database\Seeders;

use App\Models\VariationDiscount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VariationDiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp = new VariationDiscount();
        $temp->discount_id = "1";
        $temp->product_variation_id = "1";
        $temp->save();
    }
}
