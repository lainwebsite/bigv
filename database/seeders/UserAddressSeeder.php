<?php

namespace Database\Seeders;

use App\Models\UserAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp = new UserAddress();
        $temp->name = "Home";
        $temp->phone = "+65754192347";
        $temp->additional_info = "Has Green Fence";
        $temp->block_number = "1";
        $temp->street = "Blk 150A Bishan Street 11";
        $temp->unit_level = "1";
        $temp->unit_number = "221";
        $temp->building_name = "Green Watten";
        $temp->postal_code = "569933";
        $temp->user_id = "1";
        $temp->save();

        $temp = new UserAddress();
        $temp->name = "Work";
        $temp->phone = "+651234447283";
        $temp->additional_info = "Has a buldog";
        $temp->block_number = "2";
        $temp->street = "Blk 145 Lorong 2 Toa Payoh";
        $temp->unit_level = "2";
        $temp->unit_number = "333";
        $temp->building_name = "Red Payoh";
        $temp->postal_code = "310145";
        $temp->user_id = "1";
        $temp->save();
    }
}
