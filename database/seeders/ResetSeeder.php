<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->truncate();
        Product::query()->truncate();
        Cart::query()->truncate();
        CartItem::query()->truncate();
        Order::query()->truncate();
        OrderItem::query()->truncate();
    }
}
