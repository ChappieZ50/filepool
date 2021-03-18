@extends('layouts.app')

@section('site_title',' — Profile')

@section('content')
    <div class="fpool-user-wrapper col-md-10 col-sm-12">
        @component('components.user.sidebar') @endcomponent
        @component('components.user.statistics')
            @slot('file_chart_data',$file_chart_data)
        @endcomponent
    </div>
@endsection
