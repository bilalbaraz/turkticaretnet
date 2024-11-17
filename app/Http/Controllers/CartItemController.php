<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\AddCartItemToCartRequest;
use App\Http\Requests\Cart\DeleteCartItemRequest;
use App\Http\Requests\Cart\ChangeCartItemQuantityRequest;
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

            if ($cartItem->quantity + $cartData['quantity'] > $product->stock) {
                return $this->responseService->response(false, 'You cannot add more products than stock to your cart.', 400);
            }

            $this->cartItemService->addQuantityToCartItem($cartItem, $cartData['quantity']);
        } else {
            $this->cartItemService->addCartItemToCart($cartData);
        }

        return $this->responseService->response(true, null, 201);
    }

    public function changeCartItemQuantity(ChangeCartItemQuantityRequest $request, int $cartItemId)
    {
        $data = $request->validated();
        $cartItem = $this->cartItemService->cartItemExists($cartItemId);

        if (!$cartItem) {
            return $this->responseService->response(false, 'There is no cart items by given cart item ID.', 404);
        }

        $product = $this->productService->getProductById($cartItem->product_id);

        if ($cartItem->quantity + $data['quantity'] > $product->stock) {
            return $this->responseService->response(false, 'You cannot add more products than stock to your cart.', 400);
        }

        $this->cartItemService->addQuantityToCartItem($cartItem, $data['quantity']);

        return $this->responseService->response();
    }

    public function deleteCartItemFromCart(DeleteCartItemRequest $request, int $cartItemId)
    {
        $data = $request->validated();

        $cartItem = $this->cartItemService->cartItemExists($cartItemId);

        if (!$cartItem) {
            return $this->responseService->response(false, 'There is no cart items by given cart item ID.', 404);
        }

        $cartItem->delete();

        return $this->responseService->response();
    }
}
