<?php

namespace Database\Seeders;

use App\Models\PickupMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PickupMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp = new PickupMethod();
        $temp->name = "Delivery";
        $temp->save();

        $temp = new PickupMethod();
        $temp->name = "Self Pick-Up";
        $temp->save();
    }
}
