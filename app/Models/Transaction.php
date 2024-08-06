<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\LaundryType;
use App\Models\PaymentType;
use App\Models\PaymentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transaction';
    protected $guarded = ['id'];

    public function transaction_customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function transaction_laundrytype()
    {
        return $this->belongsTo(LaundryType::class, 'laundry_type_id');
    }

    public function transaction_paymentstatus()
    {
        return $this->belongsTo(PaymentStatus::class, 'payment_status_id');
    }

    public function transaction_paymenttype()
    {
        return $this->belongsTo(PaymentType::class, 'payment_type_id');
    }
}
