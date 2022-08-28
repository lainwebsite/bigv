<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(DiscountTypeSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(PickupMethodSeeder::class);
        $this->call(TransactionStatusSeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(UserTierSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(VendorLocationSeeder::class);
        $this->call(VendorSeeder::class);
        $this->call(PickupTimeSeeder::class);
    }
}
