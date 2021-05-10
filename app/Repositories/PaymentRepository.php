<?php

namespace App\Repositories;


use App\Models\Product;
use App\Models\Transaction;
use Iyzipay\Model\Address;
use Iyzipay\Model\CheckoutForm;
use \Iyzipay\Model\Currency;
use \Iyzipay\Model\PaymentGroup;
use \Iyzipay\Model\CheckoutFormInitialize;
use \Iyzipay\Model\BasketItem;
use \Iyzipay\Model\BasketItemType;
use \Iyzipay\Options;
use \Iyzipay\Model\Buyer;
use \Iyzipay\Request\CreateCheckoutFormInitializeRequest;
use \Iyzipay\Model\Locale;
use Iyzipay\Request\RetrieveCheckoutFormRequest;

class PaymentRepository
{
    public static function iyzico($product)
    {
        $user = auth()->user();
        $sid = session()->getId();
        $request = new CreateCheckoutFormInitializeRequest();

        $conversationId = self::createConversationId();
        $request->setLocale(Locale::TR);
        $request->setConversationId($product->id);
        $request->setPrice($product->price);
        $request->setPaidPrice($product->price);
        $request->setCurrency(Currency::TL);
        $request->setBasketId($product->id);
        $request->setPaymentGroup(PaymentGroup::PRODUCT);
        $request->setCallbackUrl(route('iyzico.callback', ['pid' => $product->id, 'cid' => $conversationId, 'sid' => $sid]));
        $request->setEnabledInstallments(array(2, 3, 6, 9));

        $buyer = new Buyer();
        $buyer->setId($user->id);
        $buyer->setName($user->username);
        $buyer->setSurname($user->username);
        $buyer->setEmail($user->email);
        $buyer->setIdentityNumber("00000000000");
        $buyer->setLastLoginDate(date('Y-m-d H:i:s'));
        $buyer->setRegistrationAddress("None");
        $buyer->setIp(request()->ip());
        $buyer->setCity("None");
        $buyer->setCountry("None");
        $buyer->setZipCode("None");

        $billingAddress = new Address();
        $billingAddress->setContactName($user->username);
        $billingAddress->setCity("None");
        $billingAddress->setCountry("None");
        $billingAddress->setAddress("None");
        $billingAddress->setZipCode("None");

        $basket = new BasketItem();
        $basket->setId($product->id);
        $basket->setName($product->name);
        $basket->setCategory1($product->premium_user_product ? __('page.admin.products.premium_user_products') : __('page.admin.products.storage_limit'));
        $basket->setItemType(BasketItemType::VIRTUAL);
        $basket->setPrice($product->price);
        $basketItems[0] = $basket;

        $request->setBillingAddress($billingAddress);
        $request->setBuyer($buyer);
        $request->setBasketItems($basketItems);

        $user->update(['sid' => $sid]);
        return CheckoutFormInitialize::create($request, self::options());
    }

    public static function createTransaction($pid, $uid, $cid, $status = true)
    {
        return Transaction::create([
            'payment_method'  => 'iyzico',
            'product_id'      => $pid,
            'user_id'         => $uid,
            'status'          => $status,
            'conversation_id' => $cid,
        ]);
    }

    public static function store($pid, $cid, $user)
    {
        $product = Product::where('id', $pid)->first();

        if (!$product) {
            self::createTransaction(null, $user->id, $cid, false);
            session()->flash('error', __('page.product_not_found'));
            return redirect()->route('products.index');
        }

        self::createTransaction($pid, $user->id, $cid);

        $user->update([
            'is_premium'    => $product->premium_user_product ? true : $user->is_premium,
            'storage_limit' => $product->storage_limit ? $user->storage_limit + $product->storage_limit : $user->storage_limit
        ]);
        session()->flash('success', __('page.front.product.success'));
        return redirect()->route('products.index');
    }

    public static function options()
    {
        $options = new Options();
        $options->setApiKey(trim(config('filepool.settings.iyzico_api_key')));
        $options->setSecretKey(trim(config('filepool.settings.iyzico_secret_key')));
        $options->setBaseUrl(config('filepool.settings.iyzico_sandbox') ? "https://sandbox-api.iyzipay.com" : "https://api.iyzipay.com");

        return $options;
    }

    public static function callback($cid, $token)
    {
        $request = new RetrieveCheckoutFormRequest();
        $request->setLocale(Locale::TR);
        $request->setConversationId($cid);
        $request->setToken($token);
        return CheckoutForm::retrieve($request, self::options());
    }

    public static function createConversationId()
    {
        $number = mt_rand(1000000000, 9999999999);
        return self::checkConversation($number) ? self::createConversationId() : $number;
    }

    public static function checkConversation($number)
    {
        return Transaction::where('conversation_id', $number)->exists();
    }
}
