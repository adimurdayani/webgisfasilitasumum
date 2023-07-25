@extends('layouts.backend.admin')
@section('title','Edit Galery')

@push('page-css')
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
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
                            <li class="breadcrumb-item"><a href="{{ route('app.galeries.index') }}">Galery</a></li>
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
                    <div class="ribbon ribbon-warning float-left mb-4"><i class="mdi mdi-edit mr-1"></i> Data Tabel
                        @yield('title')</div>

                    <div class="float-right mb-4 mt-0">
                        <a href="{{ route('app.galeries.index') }}" class="text-secondary"><i class="fe-list"></i>
                            List Galery</a>
                    </div>
                    <div class="ribbon-content">
                        <form action="{{ route('app.galeries.update',$galerie->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="tab_id">Tabs <span class="text-danger">*</span></label>
                                        <select name="tab_id" id="tab_id"
                                            class="form-control @error('tab_id') is-invalid @enderror" required>
                                            @foreach ($tabs as $tab)
                                            <option value="{{ $tab->id }}" {{ $galerie->tab_id == $tab->id ? 'selected'
                                                : ''
                                                }}>{{ $tab->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('tab_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="title">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" id="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            placeholder="Enter title" required value="{{ $galerie->title }}">

                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-center mb-2">
                                        <img src="{{ asset('storage/img/'.$galerie->image) }}"
                                            alt="{{ $galerie->image }}" class="img-thumbnail" width="30%">
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Image <span class="text-danger">*</span></label>
                                        <input type="file" name="image">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-sm btn-warning btn-rounded mt-2"><i
                                    class="fe-save"></i>
                                Save</button>
                        </form>
                    </div>
                </div> <!-- end card-box -->
            </div>

        </div> <!-- container -->

    </div> <!-- content -->
</div> <!-- content -->

@endsection
@include('backend.galery.includes.js.edit-js')