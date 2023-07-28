@extends('layouts.backend.admin')
@section('title','List Maps')

@push('page-css')
<link href='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css' rel='stylesheet' />
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.mapbox.css'
    rel='stylesheet' />
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/css/font-awesome.min.css'
    rel='stylesheet' />
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css'
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
                            <li class="breadcrumb-item"><a href="{{ route('app.dashboard') }}">Dashboard</a></li>
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
                    <div class="ribbon ribbon-blue float-left mb-4"><i class="mdi mdi-map-marker mr-1"></i>
                        Maps
                    </div>

                    <h5 class="text-blue mb-4 mt-0 float-right">
                        <a href="{{ route('app.maps.create') }}"><i class="mdi mdi-plus"></i>
                            Create Maps Regions</a>
                    </h5>

                    <div class="ribbon-content">

                        <div id="map" style="height: 500px;">

                        </div>
                    </div>
                </div> <!-- end card-box -->
            </div>

        </div> <!-- container -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box ribbon-box">
                    <div class="ribbon ribbon-blue float-left mb-3"><i class="mdi mdi-database mr-1"></i>
                        Data Table @yield('title')
                    </div>

                    <div class="ribbon-content table-responsive">
                        <table class="table table-striped w-100" id="table-maps">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Kecamatan</th>
                                    <th class="text-center">Kelurahan/Desa</th>
                                    <th class="text-center">Properties</th>
                                    <th class="text-center">Added At</th>
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
@include('backend.maps.includes.index-js')