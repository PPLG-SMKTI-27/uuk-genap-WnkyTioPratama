<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between mb-4">
                    <h2 class="text-xl font-bold">Riwayat Transaksi</h2>
                    <a href="{{ route('transactions.create') }}" class="bg-green-400 hover:bg-green-500 text-white px-4 py-2 rounded">Transaksi Baru</a>
                </div>
                
                @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    {{ session('success') }}
                </div>
                @endif
                
                <form action="{{ route('transactions.index') }}" method="GET" class="mb-4">
                    <input type="text" name="search" placeholder="Cari No. TRX / Pelanggan..." class="border rounded px-4 py-2" value="{{ request('search') }}">
                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Cari</button>
                </form>

                <table class="min-w-full table-auto border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2">No. Transaksi</th>
                            <th class="border px-4 py-2">Tanggal</th>
                            <th class="border px-4 py-2">Pelanggan</th>
                            <th class="border px-4 py-2">Total Harga</th>
                            <th class="border px-4 py-2">Status</th>
                            <th class="border px-4 py-2">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $trx)
                        <tr>
                            <td class="border px-4 py-2 font-mono">{{ $trx->transaction_no }}</td>
                            <td class="border px-4 py-2">{{ $trx->date }}</td>
                            <td class="border px-4 py-2">{{ $trx->customer_name }}</td>
                            <td class="border px-4 py-2">Rp {{ number_format($trx->total_price) }}</td>
                            <td class="border px-4 py-2">
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">{{ $trx->status }}</span>
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <a href="{{ route('transactions.show', $trx->id) }}" class="text-blue-500 underline">Lihat</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
