<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $elektronik = Category::where('category_name', 'Elektronik')->first();
        $pakaian = Category::where('category_name', 'Pakaian')->first();
        $makanan = Category::where('category_name', 'Makanan & Minuman')->first();

        Product::updateOrCreate(
            ['product_name' => 'Laptop ASUS'],
            [
                'category_id' => $elektronik->id,
                'price' => 7500000,
                'stock' => 10,
                'unit' => 1
            ]
        );

        Product::updateOrCreate(
            ['product_name' => 'Smartphone Samsung'],
            [
                'category_id' => $elektronik->id,
                'price' => 3500000,
                'stock' => 25,
                'unit' => 1
            ]
        );

        Product::updateOrCreate(
            ['product_name' => 'Kaos Polos'],
            [
                'category_id' => $pakaian->id,
                'price' => 50000,
                'stock' => 100,
                'unit' => 1
            ]
        );

        Product::updateOrCreate(
            ['product_name' => 'Kopi Instan'],
            [
                'category_id' => $makanan->id,
                'price' => 25000,
                'stock' => 50,
                'unit' => 1
            ]
        );
    }
}
