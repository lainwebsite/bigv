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
                $temp->featured_image = "https://bigvsg.com/wp-content/uploads/2022/07/Oreo-cheesecake-e1658978671667.jpg";
                $temp->rating = "3";
                $temp->vendor_id = "1";
                $temp->category_id = "1";
                $temp->save();

        $temp = new Product();
        $temp->name = "Milkshake";
        $temp->description = "This is a shake.";
        $temp->rating = 4.8;
        $temp->featured_image = "milkshake.png";
        $temp->vendor_id = 1;
        $temp->category_id = 1;
        $temp->save();

        $temp = new Product();
        $temp->name = "Fries";
        $temp->description = "French fries.";
        $temp->rating = 4.2;
        $temp->featured_image = "french_fries.jpeg";
        $temp->vendor_id = 2;
        $temp->category_id = 1;
        $temp->save();
    }
}
