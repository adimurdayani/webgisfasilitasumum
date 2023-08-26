@extends('layouts.backend.admin')
@section('title',__('Create New Galery'))

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
                            <li class="breadcrumb-item">
                                <a href="{{ route('app.dashboard') }}">
                                    {{ __('Dashboard') }}
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('app.galeries.index') }}">
                                    {{ __('Galery') }}
                                </a>
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
                    <div class="ribbon ribbon-blue float-left mb-4"><i class="mdi mdi-plus mr-1"></i> Data Table
                        @yield('title')</div>

                    <div class="float-right mb-4 mt-0">
                        <a href="{{ route('app.galeries.index') }}" class="text-secondary"><i class="fe-list"></i>
                            {{ __('List Galery') }}</a>
                    </div>

                    <div class="ribbon-content">
                        <form action="{{ route('app.galeries.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="tab_id">{{ __('Tabs') }} <span class="text-danger">*</span></label>
                                        <select name="tab_id" class="form-control @error('tab_id') is-invalid @enderror"
                                            required>
                                            @foreach ($tabs as $tab)
                                            <option value="{{ $tab->id }}">{{ $tab->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('tab_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="title">{{ __('Title') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="title" id="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            placeholder="Enter title" required>

                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">{{ __('Image') }} <span class="text-danger">*</span></label>
                                        <input type="file" name="image" required>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-sm btn-blue btn-rounded mt-2"><i class="fe-save"></i>
                                {{ __('Save') }}
                            </button>
                        </form>
                    </div>
                </div> <!-- end card-box -->
            </div>

        </div> <!-- container -->

    </div> <!-- content -->
</div> <!-- content -->

@endsection
@include('backend.galery.includes.js.add-js')