<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- — --}}
    <title>{{ get_setting('site_title') }}@yield('site_title')</title>

    <meta name="theme-color" content="{{ get_setting('theme_color') }}">
    <meta name="description" content="@yield('site_description',get_setting('site_description'))">
    <meta name="keywords" content="@yield('site_keywords',get_setting('site_keywords'))">
    <meta name="robots" content="@yield('site_robots','index, follow')">

    <meta property="og:type" content="@yield('og_site_type','website')">
    <meta property="og:site_name" content="@yield('og_website_name',get_setting('website_name'))">
    <meta property="og:description" content="@yield('og_site_description',get_setting('site_description'))">
    <meta property="og:title" content="@yield('og_site_title',get_setting('site_title'))">
    <meta property="og:url" content="@yield('og_site_url',url()->current())">
    <meta property="og:image" content="@yield('og_site_image',website_file_url(get_setting('logo')))">

    <meta name="twitter:title" content="@yield('twitter_site_title',get_setting('site_title'))">
    <meta name="twitter:description" content="@yield('twitter_site_description',get_setting('site_description'))">
    <meta name="twitter:card" content="@yield('site_twitter_card','summary')">
    <meta name="twitter:site" content="@yield('twitter_site_url',url('/'))">

    <link href="{{get_favicon()}}" rel="shortcut icon">
    <link href="{{get_favicon()}}"
          type="image/{{ get_setting('favicon_mime', 'ico') }}" rel="icon" sizes="48x48">
    <link rel="apple-touch-icon" href="{{get_favicon()}}" sizes="48x48">

    {!! get_analytics_script() !!}
    @if (has_ad('mobile'))
        {!! get_ad('mobile') !!}
    @endif

    <style>
        :root {
            --primary-color: {{ get_setting('theme_color') }};
        }

    </style>

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    @yield('styles')
</head>
<body>

@includeWhen(!isset($no_header),'layouts.header')

<div class="page-wrapper container-fluid">
    @yield('content')
</div>

<script>
    window.routes = {
        file_destroy: '{{ route('user.files') . '/destroy' }}',
        file_download: '{{ route('file.download')}}',
    };

    window.filepool = {
        g_recaptcha_site_key: '{{get_setting('recaptcha_site_key')}}',
        auth: {{auth()->check() ? 'true' : 'false'}},
        theme: '{{ get_setting('theme_color') }}',
        premium: {{auth()->check() && auth()->user()->is_premium ? 'true' : 'false'}},
        error_text: '{{__('page.server_error')}}',
        payment_success_text: '{{__('page.payment_success_text')}}',
        password_incorrect: '{{__('page.password_incorrect')}}',
        pay: '{{__('page.admin.js.pay')}}',
        currency: '{{__('page.currency')}}',
        trans: {
            confirm_text: '{{__('page.admin.js.confirm_text')}}',
            files: '{{__('page.admin.js.files')}}',
            usage: '{{__('page.admin.js.usage')}}',
            copied: '{{__('page.admin.js.copied')}}',
            close: '{{__('page.admin.js.close')}}',
            confirm_delete_button: '{{__('page.admin.js.confirm_delete_button')}}',
            file_delete: '{{__('page.admin.js.file_delete')}}',
            avatar_delete: '{{__('page.admin.js.avatar_delete')}}',
            empty: '{{__('page.admin.js.empty')}}',
            used: '{{__('page.admin.js.used')}}',
            password_confirm: '{{__('page.admin.js.password_confirm')}}',
            password_confirm_final: '{{__('page.admin.js.password_confirm_final')}}',
            enter_password: '{{__('page.admin.js.enter_password')}}',
            password_error: '{{__('page.admin.js.password_error')}}',
            download_file: '{{__('page.admin.js.download_file')}}',
            months: '{{__('page.admin.months')}}',
            buy_now_modal: '{{__('page.website.product.buy_now_modal')}}'
        }
    };

</script>
<script src="{{ asset('assets/js/app.js') }}"></script>
@yield('scripts')
</body>

</html>
