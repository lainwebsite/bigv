<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp = new Discount();
        $temp->name = "Merdeka Discount";
        $temp->code = "a";
        $temp->amount = "5";
        $temp->duration_start = "2022-08-18 10:12:37";
        $temp->duration_end = "2022-09-18 10:12:37";
        $temp->type_id = "3";
        $temp->save();

        $temp = new Discount();
        $temp->name = "Free Shipping Discount";
        $temp->amount = "10";
        $temp->code = "b";
        $temp->duration_start = "2022-08-15 10:12:37";
        $temp->duration_end = "2022-09-15 10:12:37";
        $temp->type_id = "1";
        $temp->save();
    }
}
