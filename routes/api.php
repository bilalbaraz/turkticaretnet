<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '', 'middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::post('register', [AuthController::class, 'register'])->name('register');
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });

    Route::group(['prefix' => 'products', 'as' => 'product.'], function () {
        Route::get('', [ProductController::class, 'index'])->name('index');
        Route::get('{id}', [ProductController::class, 'getProductDetailById'])->name('get_product_detail_by_id');
        Route::post('', [ProductController::class, 'createProduct'])->name('create_product');
        Route::put('{id}', [ProductController::class, 'updateProduct'])->name('update_product');
        Route::delete('{id}', [ProductController::class, 'deleteProduct'])->name('delete_product');
    });

    Route::group(['prefix' => 'cart', 'as' => 'cart.'], function () {
        Route::get('', [CartController::class, 'getCartByUserId'])->name('get_cart_by_user_id');

        Route::group(['prefix' => 'items', 'as' => 'item.'], function () {
            Route::post('', [CartItemController::class, 'getCartItemsByCartId'])->name('get_cart_items_by_cart_id');
            Route::put('{id}', [CartItemController::class, 'changeCartItemQuantity'])->name('change_cart_item_quantity');
            Route::delete('{id}', [CartItemController::class, 'deleteCartItemFromCart'])->name('delete_cart_item_from_cart');
        });
    });

    Route::group(['prefix' => 'orders', 'as' => 'order.'], function () {
        Route::post('', [OrderController::class, 'createOrder'])->name('create_order');
        Route::get('', [OrderController::class, 'getOrdersByUserId'])->name('get_orders_by_user_id');
        Route::get('{id}', [OrderController::class, 'getOrderById'])->name('get_order_by_id');
    });
});
