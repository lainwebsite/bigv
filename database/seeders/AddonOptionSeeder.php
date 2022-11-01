<?php

namespace Database\Seeders;

use App\Models\AddonOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddonOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp = new AddonOption();
        $temp->name = "Deep Fry Crispy Chicken Wings";
        $temp->price = "0";
        $temp->addon_id = "1";
        $temp->save();

        $temp = new AddonOption();
        $temp->name = "Crispy Chicken Davola";
        $temp->price = "0";
        $temp->addon_id = "1";
        $temp->save();

        $temp = new AddonOption();
        $temp->name = "Truffle Fries";
        $temp->price = "0";
        $temp->addon_id = "1";
        $temp->save();

        $temp = new AddonOption();
        $temp->name = "Burrata with Parma Ham";
        $temp->price = "0";
        $temp->addon_id = "2";
        $temp->save();

        $temp = new AddonOption();
        $temp->name = "Hei Bee Hiam Prawn";
        $temp->price = "0";
        $temp->addon_id = "3";
        $temp->save();

        $temp = new AddonOption();
        $temp->name = "Sambal Creamoso";
        $temp->price = "0";
        $temp->addon_id = "3";
        $temp->save();

        $temp = new AddonOption();
        $temp->name = "Seafood Marinara";
        $temp->price = "0";
        $temp->addon_id = "3";
        $temp->save();

        $temp = new AddonOption();
        $temp->name = "Aglio Olio Seafood";
        $temp->price = "0";
        $temp->addon_id = "3";
        $temp->save();

        $temp = new AddonOption();
        $temp->name = "Salmon De Vodka";
        $temp->price = "0";
        $temp->addon_id = "3";
        $temp->save();

        $temp = new AddonOption();
        $temp->name = "Hei Bee Hiam Prawn";
        $temp->price = "0";
        $temp->addon_id = "4";
        $temp->save();

        $temp = new AddonOption();
        $temp->name = "Sambal Creamoso";
        $temp->price = "0";
        $temp->addon_id = "4";
        $temp->save();

        $temp = new AddonOption();
        $temp->name = "Seafood Marinara";
        $temp->price = "0";
        $temp->addon_id = "4";
        $temp->save();

        $temp = new AddonOption();
        $temp->name = "Aglio Olio Seafood";
        $temp->price = "0";
        $temp->addon_id = "4";
        $temp->save();

        $temp = new AddonOption();
        $temp->name = "Salmon De Vodka";
        $temp->price = "0";
        $temp->addon_id = "4";
        $temp->save();
    }
}
