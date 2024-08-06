<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaundryType extends Model
{
    use HasFactory;
    protected $table = 'laundry_type';
    protected $guarded = ['id'];

    public function laundrytype_transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
