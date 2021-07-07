<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{get_setting('website_name','Imgpool')}} Admin</title>
    <link rel="stylesheet" href="{{asset('fpool/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('fpool/assets/vendors/iconfonts/ionicons/dist/css/ionicons.css')}}">
    <link rel="stylesheet" href="{{asset('fpool/assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('fpool/assets/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('fpool/assets/vendors/css/vendor.bundle.addons.css')}}">
    <link rel="stylesheet" href="{{asset('fpool/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('fpool/assets/css/app.css')}}">
    <link rel="shortcut icon" href="{{get_favicon()}}"/>
    @yield('styles')
</head>
<body>
<div class="container-scroller">
    @include('fpool.layouts.header')
    <div class="container-fluid page-body-wrapper">
        @include('fpool.layouts.sidebar')
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>

</div>

<script>
    window.routes = {
        'user_status': '{{route('admin.user.status')}}',
        'user_store': '{{route('admin.user.store')}}',
        'page_destroy': '{{route('admin.page.index')}}',
        'file_destroy': '{{route('admin.file.index')}}',
        'message_destroy': '{{route('admin.message.index')}}',
        'product_destroy': '{{route('admin.product.index')}}',
        'delete_avatar': '{{route('admin.user.delete_avatar')}}',
        'language_destroy': '{{route('admin.language.index')}}',
        'language_update_file': '{{route('admin.language.update.file')}}',
    };

    window.filepool = {
        trans: {
            title: '{{__('page.admin.js.admin.are_you_sure')}}',
            cancel: '{{__('page.admin.js.admin.cancel')}}',
            close: '{{__('page.admin.js.admin.close')}}',
            confirm_delete: '{{__('page.admin.js.admin.confirm_delete')}}',
            error: '{{__('page.server_error')}}',
            confirm_ban: '{{__('page.admin.js.admin.confirm_ban')}}',
            confirm_unban: '{{__('page.admin.js.admin.confirm_unban')}}',
            user_ban: '{{__('page.admin.js.admin.user_ban')}}',
            user_unban: '{{__('page.admin.js.admin.user_unban')}}',
            new_user_success: '{{__('page.admin.js.admin.new_user_success')}}',
            page_delete: '{{__('page.admin.js.admin.page_delete')}}',
            product_delete: '{{__('page.admin.js.admin.product_delete')}}',
            message_delete: '{{__('page.admin.js.admin.message_delete')}}',
            file_delete: '{{__('page.admin.js.admin.file_delete')}}',
            avatar_delete: '{{__('page.admin.js.admin.avatar_delete')}}',
            uploads: '{{__('page.admin.js.admin.uploads')}}',
            users: '{{__('page.admin.js.admin.users')}}',
            months: '{{__('page.admin.months')}}',
            active: '{{__('page.admin.js.admin.active')}}',
            banned: '{{__('page.admin.js.admin.banned')}}',
        }
    }
</script>
<script src="{{asset('fpool/assets/vendors/js/vendor.bundle.base.js')}}"></script>
<script src="{{asset('fpool/assets/vendors/js/vendor.bundle.addons.js')}}"></script>
<script src="{{asset('fpool/assets/js/off-canvas.js')}}"></script>
<script src="{{asset('fpool/assets/js/misc.js')}}"></script>
<script src="{{asset('fpool/assets/js/app.js')}}"></script>
@yield('scripts')
</body>
</html>
