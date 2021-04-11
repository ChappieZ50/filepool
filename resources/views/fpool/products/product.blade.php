@extends('fpool.layouts.app')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{session()->get('success')}}
        </div>
    @elseif(session()->has('error'))
        <div class="alert alert-danger">
            {{session()->get('error')}}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            @component('fpool.components.card')
                @slot('title',isset($product) ? 'Update Product' : 'New Product')
                @slot('body')
                    <form action="{{isset($product) ? route('admin.product.update',$product->id) : route('admin.product.store')}}" method="POST">
                        @isset($product) @method('PUT') @endisset
                        @csrf
                        <div class="col-xl-6  col-lg-12 mt-5 mx-auto">
                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input type="text" class="form-control" id="product_name" name="name" value="{{isset($product) ? $product->name : old('name')}}">
                                @error('name')
                                <span class="invalid-feedback d-block mt-1 ml-2" role="alert">
                                   <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="product_price">Product Price</label>
                                <input type="number" class="form-control" id="product_price" name="price" value="{{isset($product) ? $product->price : old('price')}}">
                                @error('price')
                                <span class="invalid-feedback d-block mt-1 ml-2" role="alert">
                                   <strong>{{$message}}</strong>
                                </span>
                                @enderror
                                <small class="text-muted">Dollar ($) only</small>
                            </div>
                            <div class="form-group">
                                <label for="product_storage_limit">Storage Limit</label>
                                <input type="number" class="form-control" id="product_storage_limit" name="storage_limit"
                                       value="{{isset($product) ? bytes_to_mb($product->storage_limit) : old('storage_limit')}}">
                                @error('storage_limit')
                                <span class="invalid-feedback d-block mt-1 ml-2" role="alert">
                                   <strong>{{$message}}</strong>
                                </span>
                                @enderror
                                <small class="text-muted">Megabyte (MB) Only. System automatically will change this value.</small>
                            </div>
                            <div class="form-group form-check-inline">
                                <div class="form-radio mr-2">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="premium_user_product"
                                               value="0" {{isset($product) ? ($product->premium_user_product == false ? 'checked' : (!$product->premium_user_product ? 'checked' : '')) : 'checked'}}>
                                        Storage Limit Product
                                        <i class="input-helper"></i>
                                    </label>
                                </div>
                                <div class="form-radio mr-2">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="premium_user_product"
                                               value="1" {{isset($product) && $product->premium_user_product == true ? 'checked' : ''}}>
                                        Premium User Product
                                        <i class="input-helper"></i>
                                    </label>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <button type="submit" class="btn btn-primary btn-lg float-right">{{isset($product) ? 'Update Product' : 'Create Product'}}</button>
                            <div class="clearfix"></div>
                            <div class="d-flex align-items-center justify-content-md-between justify-content-center flex-wrap mt-3">
                                <div class="text-muted">
                                    If user buy <strong>"Premium User Product"</strong>
                                    <ul class="small">
                                        <li>User can upload unlimited expire files</li>
                                        <li>Ads will not show this user</li>
                                        <li>User can only buy this product 1 time</li>
                                        <li>Storage limit will increase by "Storage Limit" value</li>
                                    </ul>
                                </div>
                                <div class="text-muted">
                                    If user buy <strong>"Storage Limit Product"</strong>
                                    <ul class="small">
                                        <li>Storage limit will increase by "Storage Limit" value</li>
                                        <li>The user can buy this product as many times as they want</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </form>
                @endslot
            @endcomponent
        </div>
    </div>
@endsection
