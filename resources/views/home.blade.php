@extends('layouts.app')

@section('content')

    @component('components.ads.home.top') @endcomponent

    @component('components.dropzone') @endcomponent

    @component('components.ads.home.bottom') @endcomponent

@endsection

@section('scripts')
    <script src="{{ asset('assets/js/dropzone.js') }}"></script>
@append
