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
        $this->call(VendorLocationSeeder::class);
        $this->call(VendorSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductVariationSeeder::class);
        $this->call(ProductImageSeeder::class);
        $this->call(TransactionStatusSeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(UserTierSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UserAddressSeeder::class);
        $this->call(PickupTimeSeeder::class);

        $this->call(DiscountSeeder::class);
        $this->call(TransactionSeeder::class);
        $this->call(TransactionDiscountSeeder::class);
        $this->call(AddonSeeder::class);
        $this->call(AddonOptionSeeder::class);
        $this->call(CartSeeder::class);
    }
}
