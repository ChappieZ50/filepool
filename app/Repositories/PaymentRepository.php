<?php

namespace App\Repositories;


use App\Models\Transaction;
use Stripe\Charge;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;

class PaymentRepository
{
    public static function stripe($token, $product)
    {
        Stripe::setApiKey(config('filepool.settings.stripe_secret'));
        try {
            Charge::create([
                "amount"      => $product->price * 100,
                "currency"    => 'usd',
                "source"      => $token,
                "description" => 'Email: ' . auth()->user()->email . ' Product: ' . $product->name,
            ]);
        } catch (ApiErrorException $e) {
            self::storeTransaction('stripe', $product->id, false);
            return back()->withErrors('fatal_error', $e->getMessage());
        }

        self::storeTransaction('stripe', $product->id);
        return true;
    }

    public static function storeTransaction($name, $product, $status = true)
    {
        return Transaction::create([
            'payment_method' => $name,
            'product_id'     => $product,
            'user_id'        => auth()->user()->id,
            'status'         => $status,
        ]);
    }
}
