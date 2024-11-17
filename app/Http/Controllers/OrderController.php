<?php

namespace App\Http\Controllers;

use App\Services\ResponseService;

class OrderController extends Controller
{
    private ResponseService $responseService;

    public function __construct(ResponseService $responseService)
    {
        $this->responseService = $responseService;
    }

    public function createOrder()
    {
        return $this->responseService->response();
    }

    public function getOrdersByUserId()
    {
        return $this->responseService->response();
    }

    public function getOrderById()
    {
        return $this->responseService->response();
    }
}
