<header class="navbar navbar-header navbar-header-fixed">
    <a href="" id="mainMenuOpen" class="burger-menu"><i data-feather="menu"></i></a>
    <div class="navbar-brand">
        <a href="{{ url('/') }}" class="df-logo">GED<span>Mila</span></a>
    </div>{{-- navbar-brand --}}

    <div id="navbarMenu" class="navbar-menu-wrapper">
        <div class="navbar-menu-header">
            <a href="{{ url('/') }}" class="df-logo">GED<span>Mila</span></a>
            <a id="mainMenuClose" href=""><i data-feather="x"></i></a>
        </div>{{-- navbar-menu-header --}}

        <ul class="nav navbar-menu">
            {{-- Start Nav BAR items --}}
            <li class="nav-label pd-l-20 pd-lg-l-25 d-lg-none">@lang('Main Menu')</li>
            @include('partials.theme.menu.main')
            {{-- Start Nav BAR items --}}
        </ul>


    </div>{{-- navbar-menu-wrapper --}}


    <div class="navbar-right">
        {{--<a id="navbarSearch" href="" class="search-link"><i data-feather="search"></i></a>--}}

        @if (app('impersonate')->isImpersonating())
            <a href="{{ route('impersonate.leave') }}" class="navbar-toggler text-danger hidden-md">
                <i class="fas fa-user-secret"></i>
            </a>
        @endif

        {{-- Start Notifications Section
        @include('partials.theme.right_nav.notifications')
        End Notifications Section --}}

        {{-- Start Profile Section --}}
        @include('partials.theme.right_nav.profile')
        {{-- End Profile Section --}}

    </div>{{-- navbar-right --}}


        {{-- Start Search Section --}}
        {{-- End Search Section --}}



</header>{{-- navbar --}}