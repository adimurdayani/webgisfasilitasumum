@extends('layouts.backend.admin')
@section('title',__('Coordinates'))

@push('page-css')
<link href='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css' rel='stylesheet' />
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.mapbox.css'
    rel='stylesheet' />
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/css/font-awesome.min.css'
    rel='stylesheet' />
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css'
    rel='stylesheet' />
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v1.0.0/MarkerCluster.css' rel='stylesheet' />
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
@endpush

@section('content')

<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('app.dashboard') }}">{{__('Dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@yield('title')</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box ribbon-box">
                    <div class="ribbon ribbon-blue float-left mb-3"><i class="mdi mdi-map-marker mr-1"></i>
                        Maps
                    </div>


                    <div class="text-right mt-0">
                        <h5 class="text-blue">
                            <a href="{{ route('app.coordinates.create') }}"><i class="mdi mdi-plus"></i>
                                {{ __('Create New') }} @yield('title')</a>
                        </h5>
                    </div>

                    <div class="ribbon-content">

                        <div id="map" style="height: 600px;">

                        </div>
                    </div>
                </div> <!-- end card-box -->
            </div>

        </div> <!-- container -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box ribbon-box">
                    <div class="ribbon ribbon-blue float-left mb-3"><i class="mdi mdi-database mr-1"></i>
                        {{ __('Data Table') }} @yield('title')
                    </div>

                    <div class="ribbon-content table-responsive">
                        <table class="table table-striped w-100" id="table-coordinate">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">{{ __('Region') }}</th>
                                    <th class="text-center">{{ __('Education') }}</th>
                                    <th class="text-center">{{ __('Title Place') }}</th>
                                    <th class="text-center">{{ __('Description') }}</th>
                                    <th class="text-center">{{ __('Color Marker') }}</th>
                                    <th class="text-center">{{ __('Symbol Marker') }}</th>
                                    <th class="text-center">{{ __('Added At') }}</th>
                                    <th class="text-center">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div> <!-- end card-box -->
            </div>
            <div class="col-lg-12">
                <div class="card-box ribbon-box">
                    <div class="ribbon ribbon-blue float-left mb-3"><i class="mdi mdi-database mr-1"></i>
                        {{ __('Data Table') }} File @yield('title')
                    </div>

                    <div class="ribbon-content table-responsive">
                        <table class="table table-striped w-100" id="table-file-coordinate">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">{{ __('Title Place') }}</th>
                                    <th class="text-center">{{ __('Description') }}</th>
                                    <th class="text-center">{{ __('Color Marker') }}</th>
                                    <th class="text-center">{{ __('Symbol Marker') }}</th>
                                    <th class="text-center">{{ __('File GeoJSON') }}</th>
                                    <th class="text-center">{{ __('Added At') }}</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div> <!-- end card-box -->
            </div>

        </div> <!-- container -->

    </div> <!-- content -->
</div> <!-- content -->

@endsection
@include('backend.map-latlng.includes.index-js')