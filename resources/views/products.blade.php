@extends('layouts.app')

@section('content')
    <div class="fpool-products-wrapper p-lg-5 pt-3">
        <div class="fpool-products-content mt-lg-5 col-10 p-0">
            @forelse($products as $product)
                @if($product->premium_user_product)
                    <div class="fpool-product card-deck mb-3 text-center col-xl-4 col-lg-6 col-md-12">
                        <div class="card mb-4 box-shadow">
                            <div class="card-header">
                                <h4 class="my-0 font-weight-normal">{{$product->name}}</h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title">${{$product->price}}</h1>
                                <ul class="product-features list-unstyled mt-3 mb-4">
                                    <li class="product-feature">Premium User</li>
                                    <li class="product-feature">Storage Files Forever</li>
                                    <li class="product-feature">No Ads</li>
                                    @if($product->storage_limit)
                                        <li class="product-feature">{{readable_size_clearly(bytes_to_mb($product->storage_limit))}} increase storage</li>
                                    @endif
                                </ul>
                                @if(auth()->user()->is_premium)
                                    <a href="#" class="btn btn-block fpool-button disabled">Purchased</a>
                                @else
                                    <a href="#" class="btn btn-block fpool-button">Buy Now</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="fpool-product card-deck mb-3 text-center col-xl-4 col-lg-6 col-md-12">
                        <div class="card mb-4 box-shadow">
                            <div class="card-header">
                                <h4 class="my-0 font-weight-normal">{{$product->name}}</h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title">${{$product->price}}</h1>
                                <ul class="product-features list-unstyled mt-3 mb-4">
                                    <li class="product-feature">{{readable_size_clearly(bytes_to_mb($product->storage_limit))}} increase storage</li>
                                </ul>
                                <a href="#" class="btn btn-block fpool-button buy-product">Buy Now</a>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <h3 class="text-center">Products not added yet</h3>
            @endforelse
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('assets/css/products.css')}}">
@append
