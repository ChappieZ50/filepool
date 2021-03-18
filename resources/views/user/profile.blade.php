@extends('layouts.app')

@section('site_title',' — Profile')

@section('content')
    <div class="fpool-user-wrapper col-md-10 col-sm-12">
        @component('components.user.sidebar') @endcomponent
        @component('components.user.profile')
            @slot('user',$user)
        @endcomponent
    </div>
@endsection
