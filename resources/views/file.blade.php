@extends('layouts.app')

@section('site_robots','noindex')

@section('content')
    <div class="fpool-file-wrapper mx-auto mt-4 d-flex flex-wrap align-items-start justify-content-center col-md-10 col-sm-12">
        @component('components.file.user')
            @slot('user',$file->user)
            @slot('file',$file)
        @endcomponent

        @component('components.file.file')
            @slot('file',$file)
        @endcomponent
    </div>
@endsection
