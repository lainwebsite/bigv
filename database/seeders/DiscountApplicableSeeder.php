<?php

namespace Database\Seeders;

use App\Models\DiscountApplicable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountApplicableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp = new DiscountApplicable();
        $temp->name = "Product";
        $temp->save();

        $temp = new DiscountApplicable();
        $temp->name = "Vendor";
        $temp->save();

        $temp = new DiscountApplicable();
        $temp->name = "Category";
        $temp->save();
    }
}
