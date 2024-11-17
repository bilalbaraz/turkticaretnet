<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getProducts(): Collection
    {
        return $this->product->get();
    }

    public function getProductById(int $productId): ?Product
    {
        return $this->product->where(['id' => $productId])->first();
    }

    public function deleteProductById(int $productId)
    {
        return $this->product->where(['id' => $productId])->delete();
    }
}