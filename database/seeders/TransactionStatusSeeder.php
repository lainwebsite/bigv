<?php

namespace Database\Seeders;

use App\Models\TransactionStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp = new TransactionStatus();
        $temp->name = "Order Pending";
        $temp->save();

        $temp = new TransactionStatus();
        $temp->name = "Paid";
        $temp->save();

        $temp = new TransactionStatus();
        $temp->name = "Delivered";
        $temp->save();

        $temp = new TransactionStatus();
        $temp->name = "Success";
        $temp->save();

        $temp = new TransactionStatus();
        $temp->name = "Canceled";
        $temp->save();

        $temp = new TransactionStatus();
        $temp->name = "Refunded";
        $temp->save();
    }
}
