<?php

namespace App\Http\Controllers;

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

    public function getProductDetailById()
    {
        return response()->json(['success' => true]);
    }

    public function createProduct()
    {
        return response()->json(['success' => true]);
    }

    public function updateProduct()
    {
        return response()->json(['success' => true]);
    }

    public function deleteProduct()
    {
        return response()->json(['success' => true]);
    }
}
