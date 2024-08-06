<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentType extends Model
{
    use HasFactory;
    protected $table = 'payment_type';
    protected $guarded = ['id'];

    public function paymenttype_transaction(){
        return $this->hasMany(Transaction::class);
    }
}
