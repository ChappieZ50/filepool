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
            <a href="javascript:;" class="btn btn-block fpool-button buy-product" id="buy_product_button" data-toggle="modal" data-target="#paymentModal" data-product="{{$product->id}}" data-product-price="{{$product->price}}" data-product-title="You paying for {{$product->name}}">Buy Now</a>
        </div>
    </div>
</div>
