<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp = new User();
        $temp->name = "User";
        $temp->email = "user@bigv.com";
        $temp->password = Hash::make('wars1234');
        $temp->email_verified_at = '2021-05-20 17:33:03';
        $temp->phone = "08123456789";
        $temp->date_of_birth = Carbon::now();
        $temp->visits = 0;
        $temp->tier_points = 1000;
        $temp->tier_id = 1;
        $temp->role_id = 1;
        $temp->save();

        $temp = new User();
        $temp->name = "Admin";
        $temp->email = "admin@bigv.com";
        $temp->password = Hash::make('wars1234');
        $temp->email_verified_at = '2021-05-20 17:33:03';
        $temp->phone = "08123456789";
        $temp->date_of_birth = Carbon::now();
        $temp->visits = 0;
        $temp->tier_points = 1000;
        $temp->tier_id = 1;
        $temp->role_id = 2;
        $temp->save();
    }
}
