<div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 d-flex flex-column">
    <div class="fpool-sidebar">
        <ul>
            <li class="{{request()->routeIs('user.profile') ? 'active' : ''}}"><a href="{{route('user.profile')}}">Profile</a></li>
            <li class="{{request()->routeIs('user.files') ? 'active' : ''}}"><a href="{{route('user.files')}}">My Files</a></li>
            <li class="{{request()->routeIs('user.statistic') ? 'active' : ''}}"><a href="{{route('user.statistic')}}">Statistics</a></li>
            <li class="{{request()->routeIs('user.transactions') ? 'active' : ''}}"><a href="{{route('user.transactions')}}">Transactions</a></li>
            @if(auth()->user()->is_admin)
                <li><a href="{{route('admin.home')}}">Admin Panel</a></li>
            @endif
            <li><a href="{{route('user.logout')}}">Logout</a></li>
        </ul>
    </div>
    <div class="text-center">
        <span class="font-weight-bold fpool-storage-limit-text">Storage Limit: <strong>{{get_storage_limit()}}</strong></span>
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
