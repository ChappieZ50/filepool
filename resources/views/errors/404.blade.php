@php $no_header = true; @endphp
@extends('layouts.app')

@section('site_title', ' — '.__('page.website.404.title'))

@section('content')
    <div class="row vh-100 justify-content-center align-items-center flex-column">
        <img src="{{ asset('assets/images/404.svg') }}" alt="page not found" class="img-fluid" style="width: 400px;">
        <h1 class="mt-5 text-center">{{__('page.website.404.title')}}</h1>
        <a href="{{ route('home') }}" class="btn fpool-button mt-3"><i data-feather="arrow-left"></i>{{__('page.website.404.back')}}</a>
    </div>
@endsection
