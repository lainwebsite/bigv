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
        $temp->name = "Chocolate Chip Cookies";
        $temp->description = "desc2";
        $temp->featured_image = "https://bigvsg.com/wp-content/uploads/2022/05/Chocolate-chip-cookie_2-1536x1152.jpg";
        $temp->rating = "4.1";
        $temp->vendor_id = "2";
        $temp->category_id = "1";
        $temp->save();

        $temp = new Product();
        $temp->name = "Almond Cookies";
        $temp->description = "desc3";
        $temp->featured_image = "https://bigvsg.com/wp-content/uploads/2022/07/Almond-Cookies-1.jpg";
        $temp->rating = "4.5";
        $temp->vendor_id = "1";
        $temp->category_id = "2";
        $temp->save();

        $temp = new Product();
        $temp->name = "Cheesy Pasta";
        $temp->description = "desc4";
        $temp->featured_image = "https://bigvsg.com/wp-content/uploads/2022/01/WhatsApp-Image-2022-01-03-at-1.25.30-AM.jpeg";
        $temp->rating = "4.8";
        $temp->vendor_id = "3";
        $temp->category_id = "5";
        $temp->save();

        $temp = new Product();
        $temp->name = "3 Course Meal - House Special Pasta for 2 Pax";
        $temp->description = "desc5";
        $temp->featured_image = "https://bigvsg.com/wp-content/uploads/2021/12/Hae-Bee-Hiam-Pasta.jpg";
        $temp->rating = "4.2";
        $temp->vendor_id = "1";
        $temp->category_id = "5";
        $temp->save();
    }
}
