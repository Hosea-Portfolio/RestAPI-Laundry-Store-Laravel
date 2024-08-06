<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentStatus extends Model
{
    use HasFactory;
    protected $table = 'payment_status';
    protected $guarded = ['id'];


    public function paymentstatus_transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
