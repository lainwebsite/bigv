<?php

namespace Database\Seeders;

use App\Models\DiscountType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp = new DiscountType();
        $temp->name = "Free Shipping";
        $temp->save();

        $temp = new DiscountType();
        $temp->name = "Percentage";
        $temp->save();

        $temp = new DiscountType();
        $temp->name = "Direct Cut";
        $temp->save();
    }
}
