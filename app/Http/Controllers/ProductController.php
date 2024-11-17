<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnums;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getProducts();

        return response()->json(['success' => true, 'products' => $products]);
    }

    public function getProductDetailById(int $productId)
    {
        $product = $this->productService->getProductById($productId);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'There is no products by given product ID.'
            ], 404);
        }

        return response()->json(['success' => true, 'product' => $product]);
    }

    public function createProduct(CreateProductRequest $request)
    {
        $data = $request->validated();
        $user = auth('api')->user();

        if ($user->role !== RoleEnums::ADMIN) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have permission to delete a product.'
            ], 401);
        }

        $product = $this->productService->createProduct($data);

        return response()->json(['success' => true, 'product' => $product]);
    }

    public function updateProduct(UpdateProductRequest $request, int $productId)
    {
        $data = $request->validated();
        $user = auth('api')->user();

        if ($user->role !== RoleEnums::ADMIN) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have permission to delete a product.'
            ], 401);
        }

        $product = $this->productService->getProductById($productId);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'There is no products by given product ID.'
            ], 404);
        }

        $this->productService->updateProduct($productId, $data);

        return response()->json(['success' => true]);
    }

    public function deleteProduct(int $productId)
    {
        $user = auth('api')->user();

        if ($user->role !== RoleEnums::ADMIN) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have permission to delete a product.'
            ], 401);
        }

        $product = $this->productService->getProductById($productId);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'There is no products by given product ID.'
            ], 404);
        }

        $this->productService->deleteProductById($productId);

        return response()->json(['success' => true]);
    }
}
