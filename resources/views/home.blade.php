@extends('layouts.app')

@section('content')
    <div class="fpool-home">
        @component('components.ads.home.left') @endcomponent

        @component('components.dropzone') @endcomponent

        @component('components.ads.home.right') @endcomponent
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/dropzone.js') }}"></script>
@append
