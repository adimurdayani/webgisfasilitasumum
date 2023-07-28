@extends('layouts.backend.admin')
@section('title','Edit Maps')

@push('page-css')
<link href="{{ asset('assets') }}/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet"
    type="text/css" />

<link href='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css' rel='stylesheet' />
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.mapbox.css'
    rel='stylesheet' />
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/css/font-awesome.min.css'
    rel='stylesheet' />
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css'
    rel='stylesheet' />
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
                            <li class="breadcrumb-item"><a href="{{ route('app.maps.index') }}">List Maps</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@yield('title')</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-8">
                <div class="card-box ribbon-box">
                    <div class="ribbon ribbon-warning float-left mb-3"><i class="mdi mdi-map-marker mr-1"></i>
                        Maps
                    </div>

                    <div class="float-right mb-4 mt-0">
                        <a href="{{ route('app.maps.index') }}" class="text-secondary"><i class="mdi mdi-view-list"></i>
                            List Maps</a>
                    </div>

                    <div class="ribbon-content">
                        <div id="map" style="height: 600px;"></div>
                    </div>
                </div> <!-- end card-box -->
            </div>

            <div class="col-lg-4">
                <div class="card-box ribbon-box">
                    <div class="ribbon ribbon-warning float-left mb-3"><i class="mdi mdi-plus mr-1"></i>
                        Form Content
                    </div>

                    <div class="ribbon-content">
                        <form action="{{ route('app.maps.update',$map->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group mb-3">
                                <label for="region_id">Kecamatan <span class="text-danger">*</span></label>
                                <select name="region_id" class="form-control @error('region_id') is-invalid @enderror"
                                    required data-toggle="select2">
                                    <option value="">-- Choose --</option>
                                    @foreach ($regions as $region)
                                    <option value="{{ $region->id }}" {{ $map->region_id == $region->id ? 'selected' :
                                        '' }}>{{ $region->name }}</option>
                                    @endforeach
                                </select>

                                @error('region_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="village_id">Kelurahan/Desa <span class="text-danger">*</span></label>
                                <select name="village_id" class="form-control @error('village_id') is-invalid @enderror"
                                    data-toggle="select2">
                                    <option value="{{ $map->village_id }}" selected>{{ $map->village->name }}</option>
                                </select>

                                @error('village_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <label for="color">Color Property</label>
                                <input type="text" name="color" class="form-control horizontal-colorpicker"
                                    placeholder="Enter color layer" value="{{ $map->color ?? old('color') }}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="geojson">Upload File GeoJSON</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="geojson"
                                            accept="application/json,.geojson">
                                        <label class="custom-file-label" for="geojson">Choose file</label>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-rounded btn-sm btn-warning"><i class="fe-save"></i>
                                    Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div> <!-- end card-box -->
            </div>
        </div> <!-- container -->

    </div> <!-- content -->
</div> <!-- content -->

@endsection
@include('backend.maps.includes.edit-js')