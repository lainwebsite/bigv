<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp = new Product();
        $temp->name = "Oreo Cheesecake";
        $temp->description = "desc";
        $temp->rating = "3";
        $temp->vendor_id = "1";
        $temp->category_id = "1";
        $temp->save();

        $temp = new Product();
        $temp->name = "Chocolate Chip Cookies";
        $temp->description = "desc2";
        $temp->rating = "4.1";
        $temp->vendor_id = "2";
        $temp->category_id = "1";
        $temp->save();

        $temp = new Product();
        $temp->name = "Almond Cookies";
        $temp->description = "desc3";
        $temp->rating = "4.5";
        $temp->vendor_id = "1";
        $temp->category_id = "2";
        $temp->save();
    }
}
