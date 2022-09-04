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
        $temp->time = "AM";
        $temp->save();

        $temp = new PickupTime();
        $temp->time = "PM";
        $temp->save();
    }
}
