<!-- Topbar Start -->
<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-right mb-0">


            <li class="dropdown d-none d-lg-inline-block">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen"
                    href="#">
                    <i class="fe-maximize noti-icon"></i>
                </a>
            </li>

            <li class="d-none d-lg-inline-block">
                <a class="nav-link arrow-none waves-effect waves-light" href="#">
                    @foreach (language() as $language)
                    <img src="{{ asset('vendor/blade-flags/country-'. $language->flag .'.svg') }}" alt="country-image"
                        height="16">
                    @endforeach
                </a>
            </li>

            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown"
                    href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ Auth::user()->img_user == null ? asset('assets/images/not_found.jpg') : asset('storage/public/img/'.Auth::user()->img_user) }}"
                        alt="user-image" class="rounded-circle">
                    <span class="pro-user-name ml-1">
                        {{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <a href="{{ route('app.profile.index') }}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>Profile</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="dropdown-item notify-item" onclick="event.preventDefault();
                    this.closest('form').submit();">
                            <i class="fe-log-out"></i>
                            <span>Logout</span>
                        </a>
                    </form>

                </div>
            </li>

        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="{{ route('app.dashboard') }}" class="logo logo-dark text-center">
                <span class="logo-sm">
                    <img src="{{ setting('1')->img_sm != null ? asset('storage/public/img').'/'.setting('1')->img_sm : asset('assets/images/not_found.jpg') }}"
                        alt="" height="22">
                    <!-- <span class="logo-lg-text-light">UBold</span> -->
                </span>
                <span class="logo-lg">
                    <img src="{{ setting('1')->img_lg != null ? asset('storage/public/img').'/'.setting('1')->img_lg : asset('assets/images/not_found.jpg') }}"
                        alt="" height="50">
                    <!-- <span class="logo-lg-text-light">U</span> -->
                </span>
            </a>

            <a href="{{ route('app.dashboard') }}" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="{{ setting('1')->img_sm != null ? asset('storage/public/img').'/'.setting('1')->img_sm : asset('assets/images/not_found.jpg') }}"
                        alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="{{ setting('1')->img_lg != null ? asset('storage/public/img').'/'.setting('1')->img_lg : asset('assets/images/not_found.jpg') }}"
                        alt="" height="50">
                </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>

            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>

            <li class="dropdown d-none d-xl-block">
                <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"
                    role="button" aria-haspopup="false" aria-expanded="false">
                    Create New
                    <i class="mdi mdi-chevron-down"></i>
                </a>
                <div class="dropdown-menu">
                    <!-- item-->
                    <a href="{{ route('app.posts.create') }}" class="dropdown-item">
                        <i class="fe-share mr-1"></i>
                        <span>Create Post</span>
                    </a>

                    <!-- item-->
                    <a href="{{ route('app.galeries.create') }}" class="dropdown-item">
                        <i class="fe-image mr-1"></i>
                        <span>Create Galery</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">
                        <i class="fe-headphones mr-1"></i>
                        <span>Help & Support</span>
                    </a>

                </div>
            </li>

            <li class="d-none d-xl-block">
                <a href="/" target="_blank" class="nav-link waves-effect waves-light">
                    Website
                </a>
            </li>


        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<!-- end Topbar -->