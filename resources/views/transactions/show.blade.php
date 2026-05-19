<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between mb-4">
                    <h2 class="text-xl font-bold">Detail Transaksi #{{ $transaction->transaction_no }}</h2>
                    <a href="{{ route('transactions.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
                </div>

                <div class="mb-6">
                    <p><strong>Tanggal:</strong> {{ $transaction->date }}</p>
                    <p><strong>Nama Pelanggan:</strong> {{ $transaction->customer_name }}</p>
                    <p><strong>Total Harga:</strong> Rp {{ number_format($transaction->total_price) }}</p>
                    <p><strong>Status:</strong> <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">{{ $transaction->status }}</span></p>
                </div>

                <h3 class="text-lg font-semibold mb-3">Produk yang Dibeli</h3>
                <table class="min-w-full table-auto border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2">Nama Produk</th>
                            <th class="border px-4 py-2">Harga Satuan</th>
                            <th class="border px-4 py-2">Jumlah</th>
                            <th class="border px-4 py-2">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaction->transaction_details as $detail)
                        <tr>
                            <td class="border px-4 py-2">{{ $detail->product->product_name }}</td>
                            <td class="border px-4 py-2">Rp {{ number_format($detail->unit_price) }}</td>
                            <td class="border px-4 py-2">{{ $detail->quantity }}</td>
                            <td class="border px-4 py-2">Rp {{ number_format($detail->subtotal) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-50">
                            <td colspan="3" class="border px-4 py-2 text-right font-bold">Total Keseluruhan:</td>
                            <td class="border px-4 py-2 font-bold">Rp {{ number_format($transaction->total_price) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
