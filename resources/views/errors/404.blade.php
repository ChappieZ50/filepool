@php $no_header = true; @endphp
@extends('layouts.app')

@section('site_title', ' — Page not found')

@section('content')
    <div class="row vh-100 justify-content-center align-items-center flex-column">
        <img src="{{ asset('assets/images/404.svg') }}" alt="page not found" class="img-fluid" style="width: 400px;">
        <h1 class="mt-5 text-center">Page not found</h1>
        <a href="{{ route('home') }}" class="btn fpool-button mt-3"><i data-feather="arrow-left"></i>Back to home</a>
    </div>
@endsection
