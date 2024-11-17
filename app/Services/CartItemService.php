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

    public function cartItemExists(int $cartItemId): ?CartItem
    {
        return $this->cartItem->where(['id' => $cartItemId])->first();
    }

    public function deleteCartItemsByProductId(int $productId): bool
    {
        return $this->cartItem->where(['product_id' => $productId])->delete();
    }
}