<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(['success' => true]);
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
