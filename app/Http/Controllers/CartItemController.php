<?php

namespace App\Http\Controllers;

use App\Services\ResponseService;

class CartItemController extends Controller
{
    private ResponseService $responseService;

    public function __construct(ResponseService $responseService)
    {
        $this->responseService = $responseService;
    }

    public function getCartItemsByCartId()
    {
        return $this->responseService->response();
    }

    public function changeCartItemQuantity()
    {
        return $this->responseService->response();
    }

    public function deleteCartItemFromCart()
    {
        return $this->responseService->response();
    }
}
