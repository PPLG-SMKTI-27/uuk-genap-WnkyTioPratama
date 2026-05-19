<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4">Buat Transaksi Baru</h2>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Oops!</strong>
                        <span class="block sm:inline">{{ $errors->first() }}</span>
                    </div>
                @endif

                <form action="{{ route('transactions.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="customer_name" class="block text-sm font-medium text-gray-700">Nama Pelanggan</label>
                        <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        @error('customer_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <h3 class="text-lg font-semibold mt-6 mb-3">Detail Produk</h3>
                    <div id="product-items">
                      
                        <div class="flex items-end space-x-4 mb-4 product-item">
                            <div class="flex-1">
                                <label for="product_id_0" class="block text-sm font-medium text-gray-700">Produk</label>
                                <select name="items[0][product_id]" id="product_id_0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                    <option value="">Pilih Produk</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" data-price="{{ $product->price }}" data-stock="{{ $product->stock }}">{{ $product->product_name }} (Stok: {{ $product->stock }})</option>
                                    @endforeach
                                </select>
                                @error('items.0.product_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="quantity_0" class="block text-sm font-medium text-gray-700">Jumlah</label>
                                <input type="number" name="items[0][quantity]" id="quantity_0" value="{{ old('items.0.quantity', 1) }}" class="mt-1 block w-24 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" min="1" required>
                                @error('items.0.quantity')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="button" class="bg-red-500 text-white px-3 py-2 rounded-md hover:bg-red-600 remove-item">Hapus</button>
                        </div>
                    </div>

                    <button type="button" id="add-product-item" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 mt-2">Tambah Produk Lain</button>

                    <div class="flex items-center justify-end mt-6">
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Simpan Transaksi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
