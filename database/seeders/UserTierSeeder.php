<?php

namespace Database\Seeders;

use App\Models\UserTier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp = new UserTier();
        $temp->name = "Bronze";
        $temp->save();

        $temp = new UserTier();
        $temp->name = "Silver";
        $temp->save();

        $temp = new UserTier();
        $temp->name = "Gold";
        $temp->save();
    }
}
