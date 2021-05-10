@extends('layouts.app')

@section('content')
    {!! $paymentForm->getCheckoutFormContent() !!}
    <div class="mt-5">
        <div id="iyzipay-checkout-form" class="responsive"></div>
    </div>
@endsection
