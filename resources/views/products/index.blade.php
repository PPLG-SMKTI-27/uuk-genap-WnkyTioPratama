<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between mb-4">
                    <h2 class="text-xl font-bold">Daftar Produk</h2>
                    <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Produk</a>
                </div>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('products.index') }}" method="GET" class="mb-4">
                    <input type="text" name="search" placeholder="Cari produk..." class="border rounded px-4 py-2" value="{{ request('search') }}">
                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Cari</button>
                </form>

                <table class="min-w-full table-auto border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2">Nama Produk</th>
                            <th class="border px-4 py-2">Kategori</th>
                            <th class="border px-4 py-2">Harga</th>
                            <th class="border px-4 py-2">Stok</th>
                            <th class="border px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td class="border px-4 py-2">{{ $product->product_name }}</td>
                            <td class="border px-4 py-2">{{ $product->category->category_name }}</td>
                            <td class="border px-4 py-2">Rp {{ number_format($product->price) }}</td>
                            <td class="border px-4 py-2">{{ $product->stock }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('products.edit', $product->id) }}" class="text-blue-500">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button class="text-red-500 ml-2" onclick="return confirm('Hapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
