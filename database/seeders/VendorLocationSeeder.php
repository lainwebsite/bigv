<?php

namespace Database\Seeders;

use App\Models\VendorLocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp = new VendorLocation();
        $temp->name = "North";
        $temp->save();

        $temp = new VendorLocation();
        $temp->name = "East";
        $temp->save();

        $temp = new VendorLocation();
        $temp->name = "South";
        $temp->save();

        $temp = new VendorLocation();
        $temp->name = "West";
        $temp->save();
    }
}
