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
        $temp->name = "Temp User";
        $temp->phone = "08123456789";
        $temp->additional_info = "no info";
        $temp->street = "ini jalan";
        $temp->building_name = "nama building";
        $temp->unit_level = 1;
        $temp->building_number = 23;
        $temp->unit_number = 34;
        $temp->postal_code = "60252";
        $temp->user_id = 1;
        $temp->save();
    }
}
