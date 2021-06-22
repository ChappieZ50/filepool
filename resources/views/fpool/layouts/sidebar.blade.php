<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="profile-image">
                    <img class="img-xs rounded-circle" src="{{avatar_url(auth()->user()->avatar)}}" alt="{{auth()->user()->username}}">
                    <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                    <p class="profile-name text-uppercase">{{get_setting('website_name','Filepool')}}</p>
                    <p class="designation">{{auth()->user()->username}}</p>
                </div>
            </a>
        </li>
        <li class="nav-item nav-category">{{__('page.admin.sidebar.main_menu')}}</li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.home')}}">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">{{__('page.admin.sidebar.dashboard')}}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.user.index')}}">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">{{__('page.admin.sidebar.users')}}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.file.index')}}">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">{{__('page.admin.sidebar.files')}}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.product.index')}}">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">{{__('page.admin.sidebar.products')}}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.transaction.index')}}">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">{{__('page.admin.sidebar.transactions')}}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.page.index')}}">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">{{__('page.admin.sidebar.pages')}}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.message.index')}}">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">{{__('page.admin.sidebar.messages')}}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.ad.index')}}">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">{{__('page.admin.sidebar.manage_ads')}}</span>
            </a>
        </li>
        <li class="nav-item nav-category">{{__('page.admin.sidebar.website')}}</li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.setting.index')}}">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">{{__('page.admin.sidebar.settings')}}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.language.index')}}">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">{{__('page.admin.sidebar.language')}}</span>
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
