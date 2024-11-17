<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductController extends Controller
{
    public function index()
    {
        $products = [
            ['id' => 1, 'name' => 'Ürün'],
        ];

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
