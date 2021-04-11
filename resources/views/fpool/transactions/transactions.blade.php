@extends('fpool.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            @component('fpool.components.card')
                @slot('title','Transactions')
                @slot('searchRoute',route('admin.transaction.index'))
                @slot('body')
                    @unless(count($transactions))
                        <h5 class="text-center mt-3">No Records Found</h5>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Username</th>
                                    <th>Product Name</th>
                                    <th>Payment Method</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->id }}</td>
                                        <td>
                                            <a href="{{ route('admin.user.show',$transaction->user->id) }}" target="_blank">{{$transaction->user->username}}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.product.edit',$transaction->product->id) }}" target="_blank">{{$transaction->product->name}}</a>
                                        </td>
                                        <td>{{ucfirst($transaction->payment_method)}}</td>
                                        <td>${{$transaction->product->price}}</td>
                                        <td>
                                            @if($transaction->status)
                                                <span class="badge badge-success badge-pill text-white">Success</span>
                                            @else
                                                <span class="badge badge-danger badge-pill text-white">Failed</span>
                                            @endif
                                        </td>
                                        <td>{{ $transaction->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $transactions->appends(['s' => request()->get('s')])->links() }}
                        </div>
                    @endunless
                @endslot
            @endcomponent
        </div>
    </div>
@endsection
