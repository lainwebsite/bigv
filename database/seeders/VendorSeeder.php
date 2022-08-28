<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp = new Vendor();
        $temp->name = "North";
        $temp->phone = "0812312313";
        $temp->email = "north@gmail.com";
        $temp->description = "desc";
        $temp->location_id = 1;
        $temp->save();
    }
}
