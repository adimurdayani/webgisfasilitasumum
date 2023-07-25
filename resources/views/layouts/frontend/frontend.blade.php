<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('seo-costume')
    <meta property="og:locale" content="en" />
    <meta property="og:type" content="website" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:url" content="{{ setting(1)->link_website }}" />
    <meta property="og:image" content="{{ asset('storage/img/'.SiteHelper::seo_setting()->og_img) }}" />
    <title>@yield('title')</title>
    <link rel="shortcut icon"
        href="{{ setting(1)->img_fav != null ? asset('storage/img').'/'.setting(1)->img_fav : asset('assets/images/not_found.jpg') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend') }}/css/plugins.css">

    @stack('page-css-front')

    <link rel="stylesheet" href="{{ asset('assets/frontend') }}/css/style.css">
</head>

<body class="onepage">
    <div class="content-wrapper">

        @include('layouts.frontend.header-top')

        @yield('content-front')


    </div>
    <!-- /.content-wrapper -->
    @include('layouts.frontend.footer')

    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <script src="{{ asset('assets/frontend') }}/js/plugins.js"></script>
    <script src="{{ asset('assets/frontend') }}/js/theme.js"></script>
    <!-- Vendor js -->
    <script src="{{ asset('assets') }}/js/vendor.min.js"></script>

    @stack('js-scripts-front')
    @stack('page-scripts-front')
    {!! SiteHelper::seo_setting()->costum_js !!}

</body>

</html>