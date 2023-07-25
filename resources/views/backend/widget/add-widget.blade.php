@extends('layouts.backend.admin')
@section('title','Create New Widget')

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
                            <li class="breadcrumb-item"><a href="{{ route('app.widgets.index') }}">Widget</a></li>
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
                    <div class="ribbon ribbon-blue float-left mb-4"><i class="mdi mdi-database mr-1"></i> Data Tabel
                        @yield('title')</div>

                    <div class="float-right mb-4 mt-0">
                        <a href="{{ route('app.widgets.index') }}" class="btn btn-sm btn-secondary btn-rounded"><i
                                class="fe-arrow-left"></i>
                            Back to Widget</a>
                    </div>
                    <div class="ribbon-content">
                        <form action="{{ route('app.widgets.store') }}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="title">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title"
                                    class="form-control @error('title') is-invalid @enderror" placeholder="Enter title"
                                    value="{{ old('title') }}">

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="location">Location <span class="text-danger">*</span></label>
                                <select name="location" id="location"
                                    class="form-control @error('location') is-invalid @enderror">
                                    <option value="right sidebar">Right Sidebar</option>
                                    <option value="footer">Footer</option>
                                </select>

                                @error('location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="content_type">Content Type <span class="text-danger">*</span></label>
                                <select name="content_type" id="content_type"
                                    class="form-control @error('content_type') is-invalid @enderror">
                                    <option value="populer post">Populer Post</option>
                                    <option value="tag">Tag</option>
                                    <option value="recent post">Recent Post</option>
                                    <option value="recomended post">Recomended Post</option>
                                    <option value="categories">Categories</option>
                                    <option value="feature post">Feature Post</option>
                                </select>

                                @error('content_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="order">Order <span class="text-danger">*</span></label>
                                <input type="number" name="order" id="order"
                                    class="form-control @error('order') is-invalid @enderror" placeholder="Enter order"
                                    value="{{ '1' ?? old('order') }}">

                                @error('order')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <h4 class="header-title mt-5 mt-sm-0">Status</h4>
                            <div class="mt-3 form-inline mb-4">
                                <div class="custom-control custom-radio mr-4">
                                    <input type="radio" id="customRadio1" name="is_active" value="1" checked
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Show</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="is_active" value="0"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">Hide</label>
                                </div>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-sm btn-rounded btn-blue"><i class="fe-save"></i>
                                    Save</button>
                            </div>
                        </form>
                    </div> <!-- end card-box -->
                </div>

            </div> <!-- container -->

        </div> <!-- content -->
    </div> <!-- content -->
</div>
@endsection

@include('backend.widget.includes.add-js')