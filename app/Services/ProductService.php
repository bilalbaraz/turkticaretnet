<?php

namespace App\Services;

use App\Models\CartItem;
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

    public function createProduct(array $productData): ?Product
    {
        return $this->product->create($productData);
    }

    public function updateProduct(int $productId, array $productData): bool
    {
        return $this->product->where(['id' => $productId])->update($productData);
    }

    public function deleteProductById(int $productId)
    {
        return $this->product->where(['id' => $productId])->delete();
    }

    public function decreaseStockByProductId(int $productId, int $quantity)
    {
        return $this->product->where(['id' => $productId])->decrement('stock', $quantity);
    }

    public function hasProductStock(CartItem $cartItem): bool
    {
        return $cartItem->quantity > $cartItem->product->stock;
    }
}