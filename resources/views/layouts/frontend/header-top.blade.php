<header class="wrapper bg-gray">
    <nav class="navbar navbar-expand-lg center-logo transparent navbar-light">
        <div class="container flex-lg-row flex-nowrap align-items-center">
            <div class="navbar-brand w-100">
                <a href="/">
                    <img src="{{ setting(1)->img_fav == null ? asset('assets/images/not_found.jpg') : asset('storage/public/img/'. setting(1)->img_fav) }}"
                        width="40"
                        srcset="{{ setting(1)->img_fav == null ? asset('assets/images/not_found.jpg') : asset('storage/public/img/'. setting(1)->img_fav) }} 2x"
                        alt="{{ setting(1)->app_name }}" />
                </a>
            </div>
            <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
                <div class="offcanvas-header d-lg-none">
                    <h3 class="text-white fs-30 mb-0">WEBGIS</h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body ms-lg-auto d-flex flex-column h-100">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link scroll active" href="#home">Home</a></li>
                        <li class="nav-item"><a class="nav-link scroll" href="#maps">Map</a></li>
                        <li class="nav-item"><a class="nav-link scroll" href="#news">News</a></li>
                        <li class="nav-item"><a class="nav-link scroll" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link scroll" href="#contact">Contact</a></li>
                    </ul>
                    <!-- /.navbar-nav -->
                    <div class="offcanvas-footer d-lg-none">
                        <div>
                            <a href="mailto:{{ setting(1)->email }}" class="link-inverse">{{ setting(1)->email }}</a>
                            <br /> {{ setting(1)->phone }} <br />
                            <nav class="nav social social-white mt-4">
                                <a href="{{ setting(1)->link_twitter }}"><i class="uil uil-twitter"></i></a>
                                <a href="{{ setting(1)->link_facebook }}"><i class="uil uil-facebook-f"></i></a>
                                <a href="{{ setting(1)->link_whatsapp }}"><i class="uil uil-whatsapp"></i></a>
                                <a href="{{ setting(1)->link_instagram }}"><i class="uil uil-instagram"></i></a>
                                <a href="{{ setting(1)->link_youtube }}"><i class="uil uil-youtube"></i></a>
                            </nav>
                            <!-- /.social -->
                        </div>
                    </div>
                    <!-- /.offcanvas-footer -->
                </div>
                <!-- /.offcanvas-body -->
            </div>
            <!-- /.navbar-collapse -->
            <div class="navbar-other w-100 d-flex ms-auto">
                <ul class="navbar-nav flex-row align-items-center ms-auto">
                    <li class="nav-item language-select text-uppercase">
                        @foreach (language() as $language)
                        <a class="nav-link" href="#">{{ $language->code }}</a>
                        @endforeach
                    </li>
                    <li class="nav-item d-none d-md-block">
                        <a href="{{route('login')}}" class="btn btn-sm btn-primary rounded-pill">Login</a>
                    </li>
                    <li class="nav-item d-lg-none">
                        <button class="hamburger offcanvas-nav-btn"><span></span></button>
                    </li>
                </ul>
                <!-- /.navbar-nav -->
            </div>
            <!-- /.navbar-other -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- /.navbar -->
</header>
<!-- /header -->