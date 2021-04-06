<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderByDesc('premium_user_product')->orderByDesc('id')->get();
        return view('products')->with('products', $products);
    }

    public function payment(Request $request)
    {
        Stripe::setApiKey(config('filepool.settings.stripe_secret'));

        try {
            Charge::create([
                "amount"      => 25 * 100,
                "currency"    => "usd",
                "source"      => $request->stripeToken,
                "description" => "Make payment and chill."
            ]);

            return back()->with('success', 'Your payment successful. ');

        } catch (ApiErrorException $e) {
            return back()->withErrors('fatal_error', 'Something gone wrong');
        }
    }
}
