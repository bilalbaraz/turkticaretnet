<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Collection;

class OrderService
{
    private Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function getOrdersByUserId(int $userId): Collection
    {
        return $this->order->where(['user_id' => $userId])->orderByDesc('id')->get();
    }

    public function getOrderById(int $orderId): ?Order
    {
        return $this->order->where(['id' => $orderId])->first();
    }

    public function createOrder(array $orderData, Collection $cartItems): bool
    {
        $order = $this->order->create($orderData);

        foreach ($cartItems as $cartItem) {
            $this->createOrderItemByOrder(
                $order,
                [
                    'product_id' => $cartItem->product_id,
                    'unit_price' => $cartItem->price,
                    'quantity' => $cartItem->quantity,
                ]
            );
        }

        return true;
    }

    public function createOrderItemByOrder(Order $order, array $orderItem): ?OrderItem
    {
        return $order->orderItems()->create($orderItem);
    }
}