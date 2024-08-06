<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $laundry_type_id = mt_rand(1, 2);

        $kilograms=mt_rand(2,5);

        $total_price = ($laundry_type_id == 1) ? 10000*$kilograms : 7000*$kilograms;

        $transaction_date = $this->faker->dateTimeBetween('2024-01-01', '2024-08-01');

        $finish_date = ($laundry_type_id == 1) ? (clone $transaction_date)->modify('+1 day') : (clone $transaction_date)->modify('+3 day');

        $payment_status_id =mt_rand(1, 2);

        $payment_type_id = ($payment_status_id == 1) ? mt_rand(1, 3) : 1;


        $pay = ($payment_type_id == 1) ? mt_rand($total_price,$total_price+50000): $total_price;
        $change_money = ($payment_type_id == 1) ? $pay-$total_price:0;
        return [
            'customer_id' => mt_rand(1, 10),
            'laundry_type_id' => $laundry_type_id,
            'payment_status_id' => $payment_status_id,
            'payment_type_id' => $payment_type_id,
            'transaction_date' => $transaction_date,
            'finish_date' => $finish_date,
            'kilograms' => $kilograms,
            'total_price' => $total_price,
            'pay' => $pay,
            'change_money'=>   $change_money,
            'additional_description'=>$this->faker->sentence(mt_rand(5, 20))

        ];
    }
}
