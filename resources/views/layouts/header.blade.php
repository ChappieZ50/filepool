<header class="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="page-items">
            <a class="fpool-button fpool-get-storage nav-link" href="{{ auth()->check() ? '#' : route('user.login.index') }}">
                <i data-feather="shopping-bag"></i>
                Buy Storage
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
                            {{get_setting('menu_title','About')}}
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
                            <a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a>
                            <a class="dropdown-item" href="{{ route('user.files') }}">My Files</a>
                            <a class="dropdown-item" href="{{ route('user.statistic') }}">Statistics</a>
                            @if(auth()->user()->is_admin)
                                <a class="dropdown-item" href="{{route('admin.home')}}">Admin Panel</a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a>
                        </div>
                    </li>
                </ul>
            @else
                <a class="nav-link" href="{{ route('user.login.index') }}">Sign in</a>
                <a class="nav-link fpool-button fpool-sign-up fpool-move-btn" href="{{ route('user.register.index') }}">
                    <i data-feather="user-plus"></i>
                    Sign up
                </a>
            @endauth

        </div>
    </nav>
</header>
<div class="mobile-navbar"></div>
