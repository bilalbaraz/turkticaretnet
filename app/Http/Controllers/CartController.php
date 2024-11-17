<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Services\ResponseService;

class CartController extends Controller
{
    private ResponseService $responseService;
    private CartService $cartService;

    public function __construct(ResponseService $responseService, CartService $cartService)
    {
        $this->responseService = $responseService;
        $this->cartService = $cartService;
    }

    public function getCartByUserId()
    {
        $user = auth('api')->user();
        $cart = $this->cartService->getCartByUserId($user->id);

        return $this->responseService->response(true, null, 200, ['cart' => $cart]);
    }
}
