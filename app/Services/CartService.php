<?php

namespace App\Services;

use App\Enums\CartStatusEnums;
use App\Models\Cart;

class CartService
{
    private Cart $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function getNotOrderedCartByUserId(int $userId): ?Cart
    {
        return $this->cart->firstOrCreate(['user_id' => $userId, 'status' => CartStatusEnums::CREATED]);
    }

    public function getCartByUserId(int $userId): ?Cart
    {
        return $this->cart->where(['user_id' => $userId, 'status' => CartStatusEnums::CREATED])->first();
    }
}