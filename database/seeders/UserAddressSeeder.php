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
        $temp->street = "Blk 150A Bishan Street 11";
        $temp->condo = "Green";
        $temp->estate = "Watten";
        $temp->label = "Bishan";
        $temp->house_number = "1";
        $temp->unit_number = "221";
        $temp->postal_code = "569933";
        $temp->user_id = "1";
        $temp->save();

        $temp = new UserAddress();
        $temp->name = "Work";
        $temp->phone = "+651234447283";
        $temp->additional_info = "Has a buldog";
        $temp->street = "Blk 145 Lorong 2 Toa Payoh";
        $temp->condo = "Red";
        $temp->estate = "Payoh";
        $temp->label = "Lorong";
        $temp->house_number = "2";
        $temp->unit_number = "333";
        $temp->postal_code = "310145";
        $temp->user_id = "1";
        $temp->save();
    }
}
