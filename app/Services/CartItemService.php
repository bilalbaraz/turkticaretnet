<?php

namespace App\Services;

use App\Models\CartItem;

class CartItemService
{
    private CartItem $cartItem;

    public function __construct(CartItem $cartItem)
    {
        $this->cartItem = $cartItem;
    }

    public function addCartItemToCart(array $cartItem): ?CartItem
    {
        return $this->cartItem->create($cartItem);
    }

    public function hasProductInCart(int $cartId, int $productId): ?CartItem
    {
        return $this->cartItem->where(['cart_id' => $cartId, 'product_id' => $productId])->first();
    }

    public function addQuantityToCartItem(CartItem $cartItem, int $quantity): bool
    {
        return $cartItem->update(['quantity' => $cartItem->quantity + $quantity]);
    }
}