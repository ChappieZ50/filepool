<div class="fpool-product card-deck mb-3 text-center col-xl-4 col-lg-6 col-md-12">
    <div class="card mb-4 box-shadow">
        <div class="card-header">
            <h4 class="my-0 font-weight-normal">{{$product->name}}</h4>
        </div>
        <div class="card-body">
            <h1 class="card-title pricing-card-title">${{$product->price}}</h1>
            <ul class="product-features list-unstyled mt-3 mb-4">
                <li class="product-feature">{{__('page.website.product.premium_user')}}</li>
                <li class="product-feature">{{__('page.website.product.store_files_forever')}}</li>
                <li class="product-feature">{{__('page.website.product.no_ads')}}</li>
                @if($product->storage_limit)
                    <li class="product-feature">{{readable_size_clearly(bytes_to_mb($product->storage_limit))}} {{__('page.website.product.increase_storage')}}</li>
                @endif
            </ul>


            @if(auth()->user()->is_premium)
                <a href="javascript:;" class="btn btn-block fpool-button disabled">{{__('page.website.product.purchased')}}</a>
            @else
                <form action="{{route('checkout')}}" class="w-100" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <button type="submit" class="btn btn-block fpool-button buy-product" data-id="{{$product->id}}">{{__('page.website.product.buy_now')}}</button>
                </form>
            @endif
        </div>
    </div>
</div>
