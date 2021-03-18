@extends('layouts.app')

@section('site_title',' — Register')

@section('content')
    <div class="return-to-homepage">
        <a href="{{ route('home') }}" class="return-to-homepage">
            <i data-feather="arrow-left"></i>
            <span>Homepage</span>
        </a>
    </div>
    <div class="fpool-login-wrapper container mt-5">
        <div class="fpool-login-logo">
            <a href="{{ route('home') }}">
                <img src="{{get_logo()}}" alt="logo" class="img-fluid">
            </a>
        </div>
        <div class="fpool-login col-xl-5 col-lg-8 col-md-10 col-sm-12 mx-auto">
            @error('non')
            <div class="mt-2 mb-4 alert alert-danger w-100" role="alert">
                {{$message}}
            </div>
            @enderror
            @component('components.social-login')
                @slot('title','Sign up With')
                @slot('bottom_title','OR')
            @endcomponent
            <form action="{{ route('user.register.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="{{old('username')}}">
                    @error('username')
                    <span class="invalid-feedback d-block mt-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="{{old('email')}}">
                    @error('email')
                    <span class="invalid-feedback d-block mt-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    @error('password')
                    <span class="invalid-feedback d-block mt-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="confirm_password"
                           placeholder="Confirm Password">
                    @error('password_confirmation')
                    <span class="invalid-feedback d-block mt-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group d-flex justify-content-center">
                    {!! app('captcha')->display() !!}
                    @error('g-recaptcha-response')
                    <span class="invalid-feedback d-block mt-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button class="btn fpool-button w-100" type="submit">Sign Up</button>
            </form>
        </div>
        <div class="to-register-page text-center mt-3 small">
            Already have an account ? <a href="{{ route('user.login.index') }}">Sign in</a>
        </div>
    </div>
@endsection

@section('scripts')
    @if(config()->get('captcha.secret') && config()->get('captcha.sitekey'))
        {!! NoCaptcha::renderJs() !!}
    @endif
@append
