@extends('layouts.app')

@section('site_title',' — My Images')

@section('content')
    <div class="fpool-user-wrapper col-md-10 col-sm-12">
        @component('components.user.sidebar') @endcomponent
        @component('components.user.files')
            @slot('files',$files)
        @endcomponent
    </div>
@endsection
