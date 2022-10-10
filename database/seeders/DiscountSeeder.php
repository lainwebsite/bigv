<?php

namespace Database\Seeders;

use App\Models\Discount;
use Carbon\Carbon;
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
        $temp->name = "1 Opening Promo";
        $temp->code = "bigvopen1";
        $temp->description = "Launching Discount";
        $temp->amount = "10";
        $temp->max_quota = 100;
        $temp->min_order = 1;
        $temp->min_tier_points = 0;
        $temp->duration_start = Carbon::now();
        $temp->duration_end = Carbon::now();
        $temp->type_id = 1;
        $temp->save();

        $temp = new Discount();
        $temp->name = "2 Opening Promo";
        $temp->code = "bigvopen2";
        $temp->description = "Launching Discount";
        $temp->amount = "10";
        $temp->max_quota = 100;
        $temp->min_order = 1;
        $temp->min_tier_points = 0;
        $temp->duration_start = Carbon::now();
        $temp->duration_end = Carbon::now();
        $temp->type_id = 2;
        $temp->save();

        $temp = new Discount();
        $temp->name = "3 Opening Promo";
        $temp->code = "bigvopen3";
        $temp->description = "Launching Discount";
        $temp->amount = "10";
        $temp->max_quota = 100;
        $temp->min_order = 1;
        $temp->min_tier_points = 0;
        $temp->duration_start = Carbon::now();
        $temp->duration_end = Carbon::now();
        $temp->type_id = 3;
        $temp->save();
    }
}
