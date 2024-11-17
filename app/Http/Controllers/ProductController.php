<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\DeleteProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Services\ProductService;
use App\Services\ResponseService;

class ProductController extends Controller
{
    private ResponseService $responseService;
    private ProductService $productService;

    public function __construct(ResponseService $responseService, ProductService $productService)
    {
        $this->responseService = $responseService;
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getProducts();

        return $this->responseService->response(true, null, 200, ['products' => $products]);
    }

    public function getProductDetailById(int $productId)
    {
        $product = $this->productService->getProductById($productId);

        if (!$product) {
            return $this->responseService->response(false, 'There is no products by given product ID.', 404);
        }

        return $this->responseService->response(true, null, 200, ['product' => $product]);
    }

    public function createProduct(CreateProductRequest $request)
    {
        $data = $request->validated();

        $product = $this->productService->createProduct($data);

        return $this->responseService->response(true, null, 201, ['product' => $product]);
    }

    public function updateProduct(UpdateProductRequest $request, int $productId)
    {
        $data = $request->validated();

        $product = $this->productService->getProductById($productId);

        if (!$product) {
            return $this->responseService->response(false, 'There is no products by given product ID.', 404);
        }

        $this->productService->updateProduct($productId, $data);

        return $this->responseService->response();
    }

    public function deleteProduct(DeleteProductRequest $request, int $productId)
    {
        $product = $this->productService->getProductById($productId);

        if (!$product) {
            return $this->responseService->response(false, 'There is no products by given product ID.', 404);
        }

        $this->productService->deleteProductById($productId);

        return $this->responseService->response(true, null, 200);
    }
}
