@extends('layouts.app')

@section('content')
    <div class="fpool-products-wrapper p-lg-5 pt-3">
        @if(session()->has('success'))
            <div id="payment_success"></div>
        @endif
        <div class="fpool-products-content mt-lg-5 col-10 p-0">
            @forelse($products as $product)
                @if($product->premium_user_product)
                    @component('components.products.premium-card')
                        @slot('product',$product)
                    @endcomponent
                @else
                    @component('components.products.default-card')
                        @slot('product',$product)
                    @endcomponent
                @endif
            @empty
                <h3 class="text-center">Products not added yet</h3>
            @endforelse
        </div>
    </div>

    @component('components.products.payment-modal')

    @endcomponent
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('assets/css/products.css')}}">
@append
