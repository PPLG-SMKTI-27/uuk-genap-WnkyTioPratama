<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'transaction_no',
        'date',
        'customer_name',
        'total_price',
        'status',
    ]; 

    public function transaction_details(){
        return $this->hasMany(TransactionDetail::class);
    }
}
