<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp = new PaymentMethod();
        $temp->name = "Atome";
        $temp->save();

        $temp = new PaymentMethod();
        $temp->name = "HitPay";
        $temp->save();

        $temp = new PaymentMethod();
        $temp->name = "PayNow";
        $temp->save();
    }
}
