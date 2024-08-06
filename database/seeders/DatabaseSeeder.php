<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\LaundryType;
use App\Models\PaymentType;
use App\Models\PaymentStatus;
use App\Models\Transaction;
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
        PaymentStatus::create([
            'payment_status_name' => 'Paid'
        ]);

        PaymentStatus::create([
            'payment_status_name' => 'Not yet Paid'
        ]);

        PaymentType::create([
            'payment_type_name' => 'Cash'
        ]);

        PaymentType::create([
            'payment_type_name' => 'QRis'
        ]);

        PaymentType::create([
            'payment_type_name' => 'Debit'
        ]);

        LaundryType::create([
            'laundry_type_name' => 'Express',
            'price_per_kg' => 'Rp. 10000/kg',
            'time_to_finish' => '1 Day'
        ]);

        LaundryType::create([
            'laundry_type_name' => 'Standard',
            'price_per_kg' => 'Rp. 7000/kg',
            'time_to_finish' => '3 Days'
        ]);

        Customer::factory(10)->create();
        Transaction::factory(10)->create();
    }
}
