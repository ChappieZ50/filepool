@extends('fpool.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            @component('fpool.components.card')
                @slot('title',__('page.admin.transactions.title'))
                @slot('searchRoute',route('admin.transaction.index'))
                @slot('body')
                    @unless(count($transactions))
                        <h5 class="text-center mt-3">{{__('page.admin.no_record')}}</h5>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>{{__('page.admin.transactions.id')}}</th>
                                    <th>{{__('page.admin.transactions.username')}}</th>
                                    <th>{{__('page.admin.transactions.name')}}</th>
                                    <th>{{__('page.admin.transactions.method')}}</th>
                                    <th>{{__('page.admin.transactions.price')}}</th>
                                    <th>{{__('page.admin.transactions.status')}}</th>
                                    <th>{{__('page.admin.transactions.created')}}</th>
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
                                            @if($transaction->product)
                                                <a href="{{ route('admin.product.edit',$transaction->product->id) }}" target="_blank">{{$transaction->product->name}}</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ucfirst($transaction->payment_method)}}</td>
                                        <td>
                                            @if($transaction->product)
                                                {{$transaction->product->price}}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if($transaction->status)
                                                <span class="badge badge-success badge-pill text-white">{{__('page.admin.transactions.success')}}</span>
                                            @else
                                                <span class="badge badge-danger badge-pill text-white">{{__('page.admin.transactions.failed')}}</span>
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
