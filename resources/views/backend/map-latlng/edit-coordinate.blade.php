@extends('layouts.backend.admin')
@section('title','Edit Coordinate')

@push('page-css')
<link href='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css' rel='stylesheet' />
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.mapbox.css'
    rel='stylesheet' />
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/css/font-awesome.min.css'
    rel='stylesheet' />
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css'
    rel='stylesheet' />
<link href="{{ asset('assets') }}/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet"
    type="text/css" />

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
                            <li class="breadcrumb-item"><a href="{{ route('app.coordinates.index') }}">List
                                    Coordinate</a>
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
            <div class="col-lg-8">
                <div class="card-box ribbon-box">
                    <div class="ribbon ribbon-warning float-left mb-3"><i class="mdi mdi-plus mr-1"></i>
                        Marker Coordinate
                    </div>

                    <a href="{{ route('app.coordinates.index') }}" class="text-secondary float-right mt-0"><i
                            class="fe-arrow-left"></i> List Coordinate</a>

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
                        <form action="{{ route('app.coordinates.update',$coordinate->id) }}" method="post">
                            @csrf
                            @method('put')

                            <div id="coordinte_hide">
                                <div class="form-group mb-3">
                                    <label for="region_id">Kecamatan <span class="text-danger">*</span></label>
                                    <select name="region_id"
                                        class="form-control @error('region_id') is-invalid @enderror" required
                                        data-toggle="select2">
                                        <option value="">-- Choose --</option>
                                        @foreach ($regions as $region)
                                        <option value="{{ $region->id }}" {{ $coordinate->region_id == $region->id ?
                                            'selected'
                                            : '' }}>{{ $region->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('region_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="education_id">Pendidikan <span class="text-danger">*</span></label>
                                    <select name="education_id"
                                        class="form-control @error('education_id') is-invalid @enderror" required
                                        data-toggle="select2">
                                        <option value="">-- Choose --</option>
                                        @foreach ($educations as $education)
                                        <option value="{{ $education->id }}" {{ $coordinate->education_id ==
                                            $education->id
                                            ?
                                            'selected'
                                            : '' }}>{{ $education->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('education_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="name">Judul <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ $coordinate->name ?? old('name') }}" placeholder="Enter nama lokasi">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="description">Description</label>
                                    <textarea rows="5" name="description" class="form-control"
                                        placeholder="Enter description">{!! $coordinate->description ?? old('description') !!}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="lat">Latitude <span class="text-danger">*</span></label>
                                            <input type="text" name="lat" id="lat"
                                                class="form-control @error('lat') is-invalid @enderror"
                                                placeholder="ex: 0.0" value="{{ $coordinate->lat ?? old('lat') }}">

                                            @error('lat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="lon">Longitude <span class="text-danger">*</span></label>
                                            <input type="text" name="lon" id="lon"
                                                class="form-control @error('lon') is-invalid @enderror"
                                                placeholder="ex: 0.0" value="{{ $coordinate->lon ?? old('lon') }}">

                                            @error('lon')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="color">Color Marker</label>
                                    <input type="text" name="color" id="horizontal-colorpicker"
                                        class="form-control @error('color') is-invalid @enderror"
                                        value="{{ $coordinate->color ?? old('color') }}">

                                    @error('color')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="icon_marker">Icon Marker</label>
                                    <input type="text" name="icon_marker"
                                        class="form-control @error('icon_marker') is-invalid @enderror"
                                        value="{{ $coordinate->icon_marker ?? old('icon_marker') }}">

                                    @error('icon_marker')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-rounded btn-sm btn-warning"><i
                                            class="fe-save"></i>
                                        Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> <!-- end card-box -->
            </div>
        </div> <!-- container -->

    </div> <!-- content -->
</div> <!-- content -->

@endsection
@include('backend.map-latlng.includes.edit-js')