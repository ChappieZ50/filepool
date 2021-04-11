@extends('fpool.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            @component('fpool.components.card')
                @slot('title','Products')
                @slot('header')
                    <div class="card-right">
                        <a href="{{route('admin.product.create')}}" class="btn btn-primary btn-fw btn-lg">
                            <i class="mdi mdi-plus-circle-outline" style="font-size: 16px;"></i>
                            New Product
                        </a>
                    </div>
                @endslot
                @slot('body')
                    @unless(count($products))
                        <h5 class="text-center mt-3">No Records Found</h5>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Storage Limit</th>
                                    <th>Premium User Product</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>${{ $product->price }}</td>
                                        <td>{{ readable_size_clearly(bytes_to_mb($product->storage_limit)) }}</td>
                                        <td>{{ $product->premium_user_product ? 'Yes' : 'No' }}</td>
                                        <td>{{ $product->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-primary social-btn"
                                               style="padding: 6px 10px;" title="Edit Product">
                                                <i class="mdi mdi-circle-edit-outline"></i>
                                            </a>
                                            <button class="btn btn-danger social-btn" id="product_delete" style="padding: 6px 10px;"
                                                    title="Delete this product" data-id="{{ $product->id }}">
                                                <i class="mdi mdi-delete-outline"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    @endunless
                @endslot
            @endcomponent
        </div>
    </div>
@endsection
