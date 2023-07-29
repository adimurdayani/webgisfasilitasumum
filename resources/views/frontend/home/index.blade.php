@extends('layouts.frontend.frontend')
@section('title','WebGis Pemetaan Fasilitas Umum')

@push('seo-costume')
<meta name="title" content="{{ SiteHelper::seo_setting()->seo_title }}">
<meta name="description" content="{{ SiteHelper::seo_setting()->seo_meta_description }}">
<meta name="keywords" content="{{ SiteHelper::seo_setting()->seo_keywords }}">
<meta name="author" content="{{ SiteHelper::seo_setting()->author_name }}">
<meta property="og:title" content="{{ SiteHelper::seo_setting()->seo_title }}" />
<meta property="og:author" content="{{ SiteHelper::seo_setting()->author }}" />
<meta property="og:description" content="{{ SiteHelper::seo_setting()->about_site }}" />
@endpush

@section('content-front')

<section id="home">
    <div class="wrapper bg-gray">
        <div class="container pt-10 pt-md-14 pb-14 pb-md-17 text-center">
            <div class="row text-center">
                <div class="col-lg-9 col-xxl-7 mx-auto" data-cues="zoomIn" data-group="welcome" data-interval="-200">
                    <h2 class="display-1 mb-4">PEMETAAN FASILITAS UMUM DI KECAMATAAN LAMASI TIMUR</h2>
                    <p class="lead fs-24 lh-sm px-md-5 px-xl-15 px-xxl-10">Memberikan kemudahan kepada pihak Kecamatan
                        Lamasi Timur dalam melakukan peningkatan mutu dan kemudahan kerja. </p>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
            <div class="row text-center mt-10">
                <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                    <figure><img class="w-auto" src="{{ asset('assets/frontend') }}/img/illustrations/3d6.png"
                            srcset="{{ asset('assets/frontend') }}/img/illustrations/3d6@2x.png 5x" alt="" /></figure>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.wrapper -->
</section>
<!-- /section -->
@include('frontend.home.includes.maps')
@include('frontend.home.includes.news')
@include('frontend.home.includes.about')
@include('frontend.home.includes.contact')
@endsection

@push('js-scripts-front')
<!-- Vendor js -->
<script src="{{ asset('assets') }}/js/vendor.min.js"></script>
<script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.min.js'></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
<script src="{{ asset('assets/leaflet/L.Control.Layers.Tree.js') }}"></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v1.0.0/leaflet.markercluster.js'></script>
@endpush

@include('frontend.home.includes.js.index-js')

@include('frontend.berita.includes.index-js')