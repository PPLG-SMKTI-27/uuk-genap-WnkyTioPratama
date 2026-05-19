<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::firstOrCreate(['category_name' => 'Elektronik', 'description' => 'Barang-barang elektronik']);
        Category::firstOrCreate(['category_name' => 'Pakaian', 'description' => 'Berbagai jenis pakaian']);
        Category::firstOrCreate(['category_name' => 'Makanan & Minuman', 'description' => 'Produk makanan dan minuman']);
        Category::firstOrCreate(['category_name' => 'Rumah Tangga', 'description' => 'Peralatan rumah tangga']);
        Category::firstOrCreate(['category_name' => 'Otomotif', 'description' => 'Suku cadang dan aksesoris kendaraan']);
    }
}
