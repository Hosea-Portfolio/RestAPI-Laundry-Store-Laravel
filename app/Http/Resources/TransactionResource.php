<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'transaction_date' => $this->transaction_date,
            'customer' => [
                'id' => $this->transaction_customer->id,
                'name' => $this->transaction_customer->name,
                'phone_number' => $this->transaction_customer->phone_number
            ],
            'payment_status' => [
                'id' => $this->transaction_paymentstatus->id,
                'payment_status_name' => $this->transaction_paymentstatus->payment_status_name,
            ],
            'payment_type' => [
                'id' => $this->transaction_paymenttype->id,
                'payment_type_name' => $this->transaction_paymenttype->payment_type_name,
            ],
            'laundry_type' => [
                'id' => $this->transaction_laundrytype->id,
                'laundry_type_name' => $this->transaction_laundrytype->laundry_type_name,
                'price_per_kg' => $this->transaction_laundrytype->price_per_kg,
                'time_to_finish' => $this->transaction_laundrytype->time_to_finish,
            ],
            'finish_date' => $this->finish_date,
            'kilograms' => $this->kilograms,
            'total_price' => $this->total_price,
            'pay' => $this->pay,
            'change' => $this->change,
            'additional_description' => $this->additional_description
        ];
    }
}
