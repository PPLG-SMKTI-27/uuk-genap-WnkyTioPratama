<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'product_name',
        'price',
        'stock',
        'unit',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function transaction_details(){
        return $this->hasMany(TransactionDetail::class);
    }
}
