<div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 d-flex flex-column">
    <div class="fpool-sidebar">
        <ul>
            <li class="{{request()->routeIs('user.profile') ? 'active' : ''}}"><a href="{{route('user.profile')}}">{{__('page.website.user.sidebar.profile')}}</a></li>
            <li class="{{request()->routeIs('user.files') ? 'active' : ''}}"><a href="{{route('user.files')}}">{{__('page.website.user.sidebar.my_files')}}</a></li>
            <li class="{{request()->routeIs('user.statistic') ? 'active' : ''}}"><a href="{{route('user.statistic')}}">{{__('page.website.user.sidebar.statistics')}}</a></li>
            <li class="{{request()->routeIs('user.transactions') ? 'active' : ''}}"><a href="{{route('user.transactions')}}">{{__('page.website.user.sidebar.payments')}}</a></li>
            @if(auth()->user()->is_admin)
                <li><a href="{{route('admin.home')}}">{{__('page.website.user.sidebar.admin_panel')}}</a></li>
            @endif
            <li><a href="{{route('user.logout')}}">{{__('page.website.user.sidebar.logout')}}</a></li>
        </ul>
    </div>
    <div class="text-center">
        <span class="font-weight-bold fpool-storage-limit-text">{{__('page.website.user.sidebar.storage_limit')}} <strong>{{get_storage_limit()}}</strong></span>
        <div id="user_storage_usage_chart"></div>
    </div>
</div>

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/apexcharts/apexcharts.css') }}">
@append

@section('scripts')
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        window.user_storage_usage = {
            used: {{get_storage_usage(auth()->user()->storage,auth()->user()->storage_limit)}},
            empty: {{get_storage_usage(auth()->user()->storage,auth()->user()->storage_limit,false)}},
        };
    </script>
@append
