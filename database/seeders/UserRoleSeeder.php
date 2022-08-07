<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp = new UserRole();
        $temp->name = "User";
        $temp->save();

        $temp = new UserRole();
        $temp->name = "Admin";
        $temp->save();
    }
}
