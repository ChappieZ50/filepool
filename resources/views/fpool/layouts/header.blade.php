<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-none d-lg-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="{{route('admin.home')}}">
            <img src="{{get_logo()}}" alt="logo" style="width: 140px;"/> </a>
        <a class="navbar-brand brand-logo-mini" href="{{route('admin.home')}}">
            <img src="{{get_logo()}}" alt="logo" style="width: 100%;"/> </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav ml-lg-auto">
            <li class="nav-item dropdown d-inline-block user-dropdown">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <img class="img-xs rounded-circle" src="{{avatar_url(auth()->user()->avatar)}}" alt="{{auth()->user()->username}}"> </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown fpool-admin-menu" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                        <img class="img-md rounded-circle" src="{{avatar_url(auth()->user()->avatar)}}" alt="{{auth()->user()->username}}">
                        <p class="mb-1 mt-3 font-weight-semibold" style="font-weight: 500;">{{auth()->user()->username}}</p>
                        <p class="font-weight-light text-muted mb-0">{{auth()->user()->email}}</p>
                    </div>
                    <a href="{{route('user.profile')}}" class="dropdown-item">
                        <i class="mdi mdi-arrow-right-drop-circle"></i>
                        {{__('page.admin.user_sidebar.my_profile')}}
                    </a>
                    <a href="{{route('admin.setting.index')}}" class="dropdown-item">
                        <i class="mdi mdi-arrow-right-drop-circle"></i>
                        {{__('page.admin.user_sidebar.settings')}}
                    </a>
                    <a href="{{route('home')}}" class="dropdown-item">
                        <i class="mdi mdi-arrow-right-drop-circle"></i>
                        {{__('page.admin.user_sidebar.website')}}
                    </a>
                    <a href="{{route('user.logout')}}" class="dropdown-item">
                        <i class="mdi mdi-arrow-right-drop-circle"></i>
                        {{__('page.admin.user_sidebar.logout')}}
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center ml-auto" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
