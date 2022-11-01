<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
                $temp = new ProductCategory();
                $temp->name = "Cakes";
                $temp->save();

                $temp = new ProductCategory();
                $temp->name = "Breads";
                $temp->save();

                $temp = new ProductCategory();
                $temp->name = "Kueh Kueh";
                $temp->save();

                $temp = new ProductCategory();
                $temp->name = "Cookies";
                $temp->save();

                $temp = new ProductCategory();
                $temp->name = "Pasta";
                $temp->save();
        }
}
