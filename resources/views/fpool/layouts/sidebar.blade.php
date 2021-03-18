<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="profile-image">
                    <img class="img-xs rounded-circle" src="{{avatar_url(auth()->user()->avatar)}}" alt="{{auth()->user()->username}}">
                    <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                    <p class="profile-name text-uppercase">{{get_setting('website_name','imgpool')}}</p>
                    <p class="designation">{{auth()->user()->username}}</p>
                </div>
            </a>
        </li>
        <li class="nav-item nav-category">Main Menu</li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.home')}}">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.user.index')}}">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Users</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.file.index')}}">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Images</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.page.index')}}">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Pages</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.message.index')}}">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Messages</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.ad.index')}}">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Manage Ads</span>
            </a>
        </li>
        <li class="nav-item nav-category">Website</li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.setting.index')}}">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Settings</span>
            </a>
        </li>
        {{--<li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon typcn typcn-coffee"></i>
                <span class="menu-title">Basic UI Elements</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/ui-features/typography.html">Typography</a>
                    </li>
                </ul>
            </div>
        </li>--}}
    </ul>
</nav>
