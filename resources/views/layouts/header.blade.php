<header class="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="page-items">
            <a class="fpool-button fpool-get-storage nav-link" href="{{ auth()->check() ? route('products.index') : route('user.login.index') }}">
                <i data-feather="shopping-bag"></i>
                {{__('page.website.home.buy_storage')}}
            </a>
            <button class="navbar-toggler collapsed border-0" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span> </span>
                <span> </span>
                <span> </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{__('page.front.menu_title')}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @forelse(get_pages() as $page)
                                @if($page->slug)
                                    <a class="dropdown-item" href="{{route('page',['slug' => $page->slug])}}">{{$page->title}}</a>
                                @endif
                            @empty
                            @endforelse
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <a class="navbar-brand" href="{{ url('/') }}">
            <img class="logo" src="{{get_logo()}}" alt="logo">
        </a>

        <div class="page-items login-items">
            @auth
                <ul class="navbar-nav fpool-move-btn">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:;" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ avatar_url(auth()->user()->avatar) }}" alt="avatar" class="nav-user-avatar">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right position-absolute shadow-lg"
                             aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.profile') }}">{{__('page.website.home.sidebar.profile')}}</a>
                            <a class="dropdown-item" href="{{ route('user.files') }}">{{__('page.website.home.sidebar.my_files')}}</a>
                            <a class="dropdown-item" href="{{ route('user.statistic') }}">{{__('page.website.home.sidebar.statistics')}}</a>
                            <a class="dropdown-item" href="{{ route('user.transactions') }}">{{__('page.website.home.sidebar.payments')}}</a>
                            @if(auth()->user()->is_admin)
                                <a class="dropdown-item" href="{{route('admin.home')}}">{{__('page.website.home.sidebar.admin_panel')}}</a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('user.logout') }}">{{__('page.website.home.sidebar.logout')}}</a>
                        </div>
                    </li>
                </ul>
            @else
                <a class="nav-link" href="{{ route('user.login.index') }}">{{__('page.website.home.sidebar.sign_in')}}</a>
                <a class="nav-link fpool-button fpool-sign-up fpool-move-btn" href="{{ route('user.register.index') }}">
                    <i data-feather="user-plus"></i>
                    {{__('page.website.home.sidebar.sign_up')}}
                </a>
            @endauth

        </div>
    </nav>
</header>
<div class="mobile-navbar"></div>
