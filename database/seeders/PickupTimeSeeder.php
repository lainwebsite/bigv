<?php

namespace Database\Seeders;

use App\Models\PickupTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PickupTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp = new PickupTime();
        $temp->time = "11:00 - 12:00";
        $temp->save();

        $temp = new PickupTime();
        $temp->time = "12:00 - 13:00";
        $temp->save();

        $temp = new PickupTime();
        $temp->time = "13:00 - 14:00";
        $temp->save();

        $temp = new PickupTime();
        $temp->time = "14:00 - 15:00";
        $temp->save();

        $temp = new PickupTime();
        $temp->time = "15:00 - 16:00";
        $temp->save();

        $temp = new PickupTime();
        $temp->time = "16:00 - 17:00";
        $temp->save();

        $temp = new PickupTime();
        $temp->time = "17:00 - 18:00";
        $temp->save();

        $temp = new PickupTime();
        $temp->time = "18:00 - 19:00";
        $temp->save();

        $temp = new PickupTime();
        $temp->time = "19:00 - 20:00";
        $temp->save();

        $temp = new PickupTime();
        $temp->time = "20:00 - 21:00";
        $temp->save();
    }
}
