<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\AddCartItemToCartRequest;
use App\Services\CartItemService;
use App\Services\CartService;
use App\Services\ProductService;
use App\Services\ResponseService;

class CartItemController extends Controller
{
    private ResponseService $responseService;
    private CartItemService $cartItemService;
    private CartService $cartService;
    private ProductService $productService;

    public function __construct(
        ResponseService $responseService,
        CartItemService $cartItemService,
        CartService $cartService,
        ProductService $productService
    ) {
        $this->responseService = $responseService;
        $this->cartItemService = $cartItemService;
        $this->cartService = $cartService;
        $this->productService = $productService;
    }

    public function addCartItemToCart(AddCartItemToCartRequest $request)
    {
        $data = $request->validated();
        $user = auth('api')->user();
        $notOrderedCart = $this->cartService->getNotOrderedCartByUserId($user->id);
        $product = $this->productService->getProductById($data['product_id']);

        $cartData = array_merge($data, ['price' => $product->price]);
        $cartData['cart_id'] = $notOrderedCart->id;

        $cartItem = $this->cartItemService->hasProductInCart($notOrderedCart->id, $product->id);

        if ($cartItem) {
            $this->cartItemService->addQuantityToCartItem($cartItem, $cartData['quantity']);
        } else {
            $this->cartItemService->addCartItemToCart($cartData);
        }

        return $this->responseService->response(true, null, 201);
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
