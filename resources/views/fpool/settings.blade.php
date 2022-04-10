@extends('fpool.layouts.app')

@section('content')
@if(session()->has('success'))
<div class="alert alert-success">
    {{session()->get('success')}}
</div>
@elseif(session()->has('error'))
<div class="alert alert-danger">
    {{session()->get('error')}}
</div>
@endif
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        @component('fpool.components.card')
        @slot('title') {{__('page.admin.settings.title')}} @endslot
        @slot('body')
        <div class="row mt-3 align-items-start">
            <ul class="nav nav-tabs col-lg-2 col-md-12 flex-column justify-content-between" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tab-1">
                        {{__('page.admin.settings.cards.website.card_title')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-2">
                        {{__('page.admin.settings.cards.logo_favicon.card_title')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-3">
                        {{__('page.admin.settings.cards.aws_api.card_title')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-4">
                        {{__('page.admin.settings.cards.login_recaptcha.card_title')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-5">
                        {{__('page.admin.settings.cards.seo.card_title')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-6">
                        {{__('page.admin.settings.cards.payment.card_title')}}
                    </a>
                </li>
            </ul>
            <div class="tab-content col-lg-10 col-md-12  mt-4">
                <div class="tab-pane fade show active" id="tab-1">
                    @include('fpool.components.settings.tabs.website')
                </div>

                <div class="tab-pane fade" id="tab-2">
                    @include('fpool.components.settings.tabs.logo-favicon')
                </div>

                <div class="tab-pane fade" id="tab-3">
                    @include('fpool.components.settings.tabs.aws-api')
                </div>

                <div class="tab-pane fade" id="tab-4">
                    @include('fpool.components.settings.tabs.login-recaptcha-api')
                </div>

                <div class="tab-pane fade" id="tab-5">
                    @include('fpool.components.settings.tabs.seo')
                </div>

                <div class="tab-pane fade" id="tab-6">
                    @include('fpool.components.settings.tabs.payment')
                </div>
            </div>
        </div>
        @endslot
        @endcomponent
    </div>
</div>
@endsection