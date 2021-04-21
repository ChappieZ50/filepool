<div class="fpool-user-container col-xl-10 col-lg-10 col-md-12 col-sm-12">
    <div class="fpool-user">
        <h2 class="fpool-sidebar-title">{{__('page.website.user.transactions.title')}}</h2>
        <hr>
        <div class="fpool-user-content">
            <div class="col-12 fpool-transactions">
                @unless(count($transactions))
                    <h4 class="text-center mt-4">{{__('page.website.user.transactions.empty')}}</h4>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-dark">
                            <thead class="thead-dark">
                            <tr>
                                <th>{{__('page.website.user.transactions.id')}}</th>
                                <th>{{__('page.website.user.transactions.name')}}</th>
                                <th>{{__('page.website.user.transactions.price')}}</th>
                                <th>{{__('page.website.user.transactions.method')}}</th>
                                <th>{{__('page.website.user.transactions.status')}}</th>
                                <th>{{__('page.website.user.transactions.created')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{$transaction->id}}</td>
                                    <td>{{$transaction->product->name}}</td>
                                    <td>${{$transaction->product->price}}</td>
                                    <td>{{ucfirst($transaction->payment_method)}}</td>
                                    <td>
                                        @if($transaction->status)
                                            <span class="badge badge-success badge-pill text-white">{{__('page.website.user.transactions.success')}}</span>
                                        @else
                                            <span class="badge badge-danger badge-pill text-white">{{__('page.website.user.transactions.failed')}}</span>
                                        @endif
                                    </td>
                                    <td>{{$transaction->created_at->diffForHumans()}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $transactions->links() }}
                    </div>
                @endunless
            </div>
        </div>
    </div>
</div>
