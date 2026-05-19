<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::query();

        $query->when($request->search, function ($q, $search) {
            $q->where('transaction_no', 'like', "%{$search}%")
              ->orWhere('customer_name', 'like', "%{$search}%");
        });

        $transactions = $query->latest()->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
           
            $transaction = Transaction::create([
                'transaction_no' => 'TRX-' . time(),
                'date' => now(),
                'customer_name' => $request->customer_name,
                'total_price' => 0, 
                'status' => 'Selesai',
            ]);

            $totalPrice = 0;

            foreach ($request->items as $item) {
                $product = Product::findOrFail($item['product_id']);

                
                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Stok produk {$product->product_name} tidak mencukupi.");
                }

                $subtotal = $product->price * $item['quantity'];

                
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->price,
                    'subtotal' => $subtotal,
                ]);

               
                $product->decrement('stock', $item['quantity']);

                $totalPrice += $subtotal;
            }

           
            $transaction->update(['total_price' => $totalPrice]);

            DB::commit();
            return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('transaction_details.product');
        return view('transactions.show', compact('transaction'));
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete(); 
        return redirect()->route('transactions.index')->with('success', 'Data transaksi berhasil dihapus.');
    }
}
