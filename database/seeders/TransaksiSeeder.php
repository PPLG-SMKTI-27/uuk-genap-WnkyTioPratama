<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        
        $product = Product::first();

        if ($product) {
            $qty = 2;
            $subtotal = $product->price * $qty;

           
            $transaction = Transaction::create([
                'transaction_no' => 'TRX-' . time(),
                'date' => now(),
                'customer_name' => 'Budi Pembeli',
                'total_price' => $subtotal,
                'status' => 'Selesai',
            ]);

          
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $product->id,
                'quantity' => $qty,
                'unit_price' => $product->price,
                'subtotal' => $subtotal,
            ]);

        
            $product->decrement('stock', $qty);
        }
    }
}
