<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Repositories\PaymentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CheckoutController extends Controller
{
    public function show(Request $request)
    {
        $product = Product::findOrFail($request->get('id'));
        if (auth()->user()->is_premium && $product->premium_user_product) {
            return back()->withErrors(['error' => __('page.website.product.purchased_response')]);
        }
        $paymentForm = PaymentRepository::iyzico($product);

        if ($paymentForm->getStatus() === 'failure') {
            return back()->withErrors(['error' => __('page.server_error')]);
        }
        return view('checkout.checkout')->with('paymentForm', $paymentForm);
    }

    public function callback(Request $request)
    {
        $pid = $request->get('pid'); // Product Id
        $cid = $request->get('cid'); // Conversation Id
        $sid = $request->get('sid'); // Session Id
        $payment = PaymentRepository::callback($cid, $request->get('token'));
        $user = User::where('sid', $sid)->first();

        if (!$user) {
            return redirect()->route('products.index')->withErrors(['error', __('page.user_not_found')]);
        }

        Auth::login($user);

        if ($payment->getErrorCode() == 5132) {
            return redirect()->route('home');
        } else if ($payment->getPaymentStatus() !== 'FAILURE') {
            return PaymentRepository::store($pid, $cid, $user);
        } else {
            PaymentRepository::createTransaction($pid, $user->id, $cid, false);
            session()->flash('error', __('page.payment_error_text'));
            return redirect()->route('products.index');
        }
    }
}
