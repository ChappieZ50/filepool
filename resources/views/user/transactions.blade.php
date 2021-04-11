@extends('layouts.app')

@section('site_title',' — Transactions')

@section('content')
    <div class="fpool-user-wrapper col-md-10 col-sm-12">
        @component('components.user.sidebar') @endcomponent
        @component('components.user.transactions')
            @slot('transactions',$transactions)
        @endcomponent
    </div>
@endsection
