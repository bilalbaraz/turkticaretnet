<?php

namespace App\Listeners;

use App\Enums\CartStatusEnums;
use App\Events\OrderCreated;
use App\Services\ProductService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderCreatedListener
{
    private ProductService $productService;

    /**
     * Create the event listener.
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        $cart = $event->cart;
        $cart->update(['status' => CartStatusEnums::ORDERED]);

        foreach ($cart->cartItems as $cartItem) {
            $this->productService->decreaseStockByProductId($cartItem->product_id, $cartItem->quantity);
        }
    }
}
