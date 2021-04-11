<div class="fpool-user-container col-xl-10 col-lg-10 col-md-12 col-sm-12">
    <div class="fpool-user">
        <h2 class="fpool-sidebar-title">Transactions</h2>
        <hr>
        <div class="fpool-user-content">
            <div class="col-12 fpool-transactions">
                @unless(count($transactions))
                    <h4 class="text-center mt-4">No Transactions Found</h4>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-dark">
                            <thead class="thead-dark">
                            <tr>
                                <th>#ID</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Created</th>
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
                                            <span class="badge badge-success badge-pill text-white">Success</span>
                                        @else
                                            <span class="badge badge-danger badge-pill text-white">Failed</span>
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
