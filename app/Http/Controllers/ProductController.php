<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\PaymentRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderByDesc('premium_user_product')->orderByDesc('id')->get();
        return view('products')->with('products', $products);
    }

    public function payment(Request $request)
    {
        $product = Product::where('id', $request->get('product'))->first();

        if ($product) {
            $pay = PaymentRepository::stripe($request->stripeToken, $product);

            if ($pay === true) {
                $user = auth()->user();
                $user->update([
                    'is_premium'    => $product->premium_user_product ? true : $user->is_premium,
                    'storage_limit' => $product->storage_limit ? $user->storage_limit + $product->storage_limit : $user->storage_limit
                ]);
                return back()->with('success', 'Your payment successful. ');
            }

            return $pay;
        }

        return back()->withErrors('fatal_error', 'Product not found');
    }
}
