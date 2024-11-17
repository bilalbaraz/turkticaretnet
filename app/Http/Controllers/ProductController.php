<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\DeleteProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Services\ProductService;

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

        $product = $this->productService->createProduct($data);

        return response()->json(['success' => true, 'product' => $product]);
    }

    public function updateProduct(UpdateProductRequest $request, int $productId)
    {
        $data = $request->validated();

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

    public function deleteProduct(DeleteProductRequest $request, int $productId)
    {
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
