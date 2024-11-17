<?php

namespace App\Services;

use App\Models\Order;
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

    public function getOrderById(int $orderId): Collection
    {
        return $this->order->where(['id' => $orderId])->first();
    }
}