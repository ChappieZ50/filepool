<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\PaymentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderByDesc('premium_user_product')->orderByDesc('id')->get();
        return view('products')->with('products', $products);
    }
}
