<?php

namespace Database\Seeders;

use App\Models\Addon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp = new Addon();
        $temp->name = "Appetizer";
        $temp->required = "0";
        $temp->product_id = "5";
        $temp->save();

        $temp = new Addon();
        $temp->name = "Salad";
        $temp->required = "0";
        $temp->product_id = "5";
        $temp->save();

        $temp = new Addon();
        $temp->name = "First Pasta";
        $temp->required = "0";
        $temp->product_id = "5";
        $temp->save();

        $temp = new Addon();
        $temp->name = "Second Pasta";
        $temp->required = "0";
        $temp->product_id = "5";
        $temp->save();
    }
}
