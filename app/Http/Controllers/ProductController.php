<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderByDesc('premium_user_product')->orderByDesc('id')->get();
        return view('products')->with('products', $products);
    }
}
