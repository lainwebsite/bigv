<?php

namespace Database\Seeders;

use App\Models\TransactionDiscount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionDiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp = new TransactionDiscount();
        $temp->transaction_id = "1";
        $temp->discount_id = "1";
        $temp->save();

        $temp = new TransactionDiscount();
        $temp->transaction_id = "1";
        $temp->discount_id = "2";
        $temp->save();
    }
}
