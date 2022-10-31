<?php

namespace Database\Seeders;

use App\Models\PickupAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PickupAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp = new PickupAddress();
        $temp->name = "BigV Storehouse";
        $temp->additional_info = "Has Green Fence";
        $temp->street = "Blk 150A Bishan Street 11";
        $temp->unit_number = "221";
        $temp->postal_code = "569933";
        $temp->save();

        $temp = new PickupAddress();
        $temp->name = "BigV Apartment";
        $temp->additional_info = "Has a buldog";
        $temp->block_number = "2";
        $temp->street = "Blk 145 Lorong 2 Toa Payoh";
        $temp->unit_level = "2";
        $temp->unit_number = "333";
        $temp->building_name = "Red Payoh";
        $temp->postal_code = "310145";
        $temp->save();
    }
}
