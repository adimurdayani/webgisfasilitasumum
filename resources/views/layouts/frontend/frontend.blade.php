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
    <meta property="og:image" content="{{ asset('storage/public/img/'.SiteHelper::seo_setting()->og_img) }}" />
    <title>@yield('title')</title>
    <link rel="shortcut icon"
        href="{{ setting(1)->img_fav != null ? asset('storage/public/img').'/'.setting(1)->img_fav : asset('assets/images/not_found.jpg') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend') }}/css/plugins.css">

    @stack('page-css-front')

    <link rel="stylesheet" href="{{ asset('assets/frontend') }}/css/style.css">

    <link href='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css' rel='stylesheet' />
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.mapbox.css'
        rel='stylesheet' />
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/css/font-awesome.min.css'
        rel='stylesheet' />
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css'
        rel='stylesheet' />
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v1.0.0/MarkerCluster.css'
        rel='stylesheet' />
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v1.0.0/MarkerCluster.Default.css'
        rel='stylesheet' />
    <link rel="stylesheet" href="{{ asset('assets/leaflet/L.Control.Layers.Tree.css') }}">


    <style>
        .ui-select {
            background: #fff;
            position: absolute;
            top: 50px;
            right: 10px;
            z-index: 100;
            padding: 10px;
            border-radius: 3px;
        }

        /* Gaya untuk popup */
        .custom-popup .leaflet-popup-content-wrapper {
            width: 300px;
            /* Ganti nilai lebar sesuai preferensi Anda */
        }

        /* Gaya untuk judul popup */
        .custom-popup .leaflet-popup-content h5 {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
        }

        /* Gaya untuk konten popup */
        .custom-popup .leaflet-popup-content p {
            font-size: 16px;
            line-height: 1.6;
        }
    </style>
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

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet-src.js" crossorigin=""></script>
    <script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>
    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.min.js'>
    </script>
    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
    <script src="{{ asset('assets/leaflet/L.Control.Layers.Tree.js') }}"></script>
    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v1.0.0/leaflet.markercluster.js'>
    </script>

    @stack('js-scripts-front')
    @stack('page-scripts-front')
    {!! SiteHelper::seo_setting()->costum_js !!}

</body>

</html>