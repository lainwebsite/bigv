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
                $temp->name = "Ally’s Gourmet";
                $temp->phone = "08123456789";
                $temp->email = "ally_gourmet@gmail.com";
                $temp->description = "descc";
                $temp->location_id = "1";
                $temp->save();

                $temp = new Vendor();
                $temp->name = "VEats";
                $temp->phone = "08123456789";
                $temp->email = "veats@gmail.com";
                $temp->description = "desccc";
                $temp->location_id = "2";
                $temp->save();

                $temp = new Vendor();
                $temp->name = "Baking Ibu";
                $temp->phone = "08123456789";
                $temp->email = "bakingibu@gmail.com";
                $temp->description = "ccc";
                $temp->location_id = "2";
                $temp->save();

                $temp = new Vendor();
                $temp->name = "Mont Delizioso";
                $temp->phone = "08123456789";
                $temp->email = "mont_delizioso@gmail.com";
                $temp->description = "ddd";
                $temp->location_id = "1";
                $temp->save();
        }
}
