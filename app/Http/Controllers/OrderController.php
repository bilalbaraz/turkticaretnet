<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatusEnums;
use App\Events\OrderCreated;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Services\CartService;
use App\Services\OrderService;
use App\Services\ProductService;
use App\Services\ResponseService;

class OrderController extends Controller
{
    private ResponseService $responseService;
    private CartService $cartService;
    private OrderService $orderService;
    private ProductService $productService;

    public function __construct(
        ResponseService $responseService,
        CartService $cartService,
        OrderService $orderService,
        ProductService $productService
    ) {
        $this->responseService = $responseService;
        $this->cartService = $cartService;
        $this->orderService = $orderService;
        $this->productService = $productService;
    }

    public function createOrder(CreateOrderRequest $request)
    {
        $data = $request->validated();
        $user = auth('api')->user();
        $cart = $this->cartService->getCartWithCartItemsByCartId($data['cart_id']);
        
        if ($cart->cartItems->count() <= 0) {
            return $this->responseService->response(false, 'Your cart is empty.', 400);
        }

        foreach ($cart->cartItems as $cartItem) {
            if ($this->productService->hasProductStock($cartItem)) {
                return $this->responseService->response(false, 'Not enough stock.', 400);
            }
        }

        $totalAmount = $this->cartService->getTotalAmountOfCart($cart);

        $this->orderService->createOrder(
            [
                'user_id' => $user->id,
                'total_amount' => $totalAmount,
                'status' => OrderStatusEnums::CREATED,
            ],
            $cart->cartItems
        );

        event(new OrderCreated($cart));

        return $this->responseService->response(true, null, 201);
    }

    public function getOrdersByUserId()
    {
        $user = auth('api')->user();
        $orders = $this->orderService->getOrdersByUserId($user->id);

        return $this->responseService->response(true, null, 200, ['orders' => $orders]);
    }

    public function getOrderById(int $orderId)
    {
        $order = $this->orderService->getOrderById($orderId);

        return $this->responseService->response(true, null, ['order' => $order]);
    }
}
