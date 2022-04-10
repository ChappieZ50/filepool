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
        @slot('title',isset($product) ? __('page.admin.products.edit.title') : __('page.admin.products.create.title'))
        @slot('body')
        <form action="{{isset($product) ? route('admin.product.update',$product->id) : route('admin.product.store')}}"
            method="POST">
            @isset($product) @method('PUT') @endisset
            @csrf
            <div class="col-xl-6  col-lg-12 mt-5 mx-auto">
                <div class="form-group">
                    <label for="product_name">{{__('page.admin.products.default.product_name')}}</label>
                    <input type="text" class="form-control" id="product_name" name="name"
                        value="{{isset($product) ? $product->name : old('name')}}">
                    @error('name')
                    <span class="invalid-feedback d-block mt-1 ml-2" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="product_price">{{__('page.admin.products.default.product_price')}}</label>
                    <input type="number" class="form-control" id="product_price" name="price"
                        value="{{isset($product) ? $product->price : old('price')}}">
                    @error('price')
                    <span class="invalid-feedback d-block mt-1 ml-2" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="product_storage_limit">{{__('page.admin.products.default.storage_limit')}}</label>
                    <input type="number" class="form-control" id="product_storage_limit" name="storage_limit"
                        value="{{isset($product) ? bytes_to_mb($product->storage_limit) : old('storage_limit')}}">
                    @error('storage_limit')
                    <span class="invalid-feedback d-block mt-1 ml-2" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                    <small class="text-muted">{{__('page.admin.products.default.storage_limit_default')}}</small>
                </div>
                <div class="form-group form-check-inline">
                    <div class="form-radio mr-2">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="premium_user_product" value="0"
                                {{isset($product) ? ($product->premium_user_product == false ? 'checked' :
                            (!$product->premium_user_product ? 'checked' : '')) : 'checked'}}>
                            {{__('page.admin.products.default.storage_limit_product')}}
                            <i class="input-helper"></i>
                        </label>
                    </div>
                    <div class="form-radio mr-2">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="premium_user_product" value="1"
                                {{isset($product) && $product->premium_user_product == true ? 'checked' : ''}}>
                            {{__('page.admin.products.default.premium_user_product')}}
                            <i class="input-helper"></i>
                        </label>
                    </div>
                </div>
                <div class="clearfix"></div>
                <button type="submit" class="btn btn-primary btn-lg float-right">{{isset($product) ?
                    __('page.admin.products.edit.button') : __('page.admin.products.create.button')}}</button>
                <div class="clearfix"></div>
                <div class="d-flex align-items-center justify-content-md-between justify-content-center flex-wrap mt-3">
                    <div class="text-muted">
                        <strong>{{__('page.admin.products.default.premium_user_product')}}</strong>
                        <ul class="small">
                            @forelse(__('page.admin.products.default.premium_user_settings') as $value)
                            <li>{{$value}}</li>
                            @empty
                            @endforelse
                        </ul>
                    </div>
                    <div class="text-muted">
                        <strong>{{__('page.admin.products.default.storage_limit_product')}}</strong>
                        <ul class="small">
                            @forelse(__('page.admin.products.default.storage_limit_settings') as $value)
                            <li>{{$value}}</li>
                            @empty
                            @endforelse
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