<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'Product 1', 'price' => 10, 'stock' => 10],
            ['name' => 'Product 2', 'price' => 20, 'stock' => 10],
            ['name' => 'Product 3', 'price' => 30, 'stock' => 10],
            ['name' => 'Product 4', 'price' => 40, 'stock' => 10],
            ['name' => 'Product 5', 'price' => 50, 'stock' => 10],
        ];

        Product::query()->truncate();

        foreach ($products as $product) {
            Product::query()->create($product);
        }
    }
}
