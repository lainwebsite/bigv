<?php

namespace Database\Seeders;

use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp = new ProductImage();
        $temp->link = "https://bigvsg.com/wp-content/uploads/2022/05/Chocolate-chip-cookie_2-1536x1152.jpg";
        $temp->product_id = "2";
        $temp->save();

        $temp = new ProductImage();
        $temp->link = "https://bigvsg.com/wp-content/uploads/2022/05/Chocolate-chip-cookie_3.jpg";
        $temp->product_id = "2";
        $temp->save();

        $temp = new ProductImage();
        $temp->link = "https://bigvsg.com/wp-content/uploads/2022/07/Almond-Cookies-1.jpg";
        $temp->product_id = "3";
        $temp->save();

        $temp = new ProductImage();
        $temp->link = "https://bigvsg.com/wp-content/uploads/2022/07/Oreo-cheesecake-e1658978671667.jpg";
        $temp->product_id = "1";
        $temp->save();
    }
}
