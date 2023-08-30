@extends('layouts.backend.admin')
@section('title',__('General Settings'))

@push('page-css')
<link href="{{ asset('assets') }}/libs/x-editable/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet"
    type="text/css" />
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

            @include('backend.settings.side-menu')

            <div class="col-lg-8">
                <div class="card-box ribbon-box">
                    <div class="ribbon ribbon-blue float-left mb-3"><i class="mdi mdi-image mr-1"></i>
                        @yield('title')
                    </div>
                    <div class="ribbon-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-center mb-4">
                                    <img src="{{ $generalSetting->img_sm != null ? asset('storage/public/img').'/'.$generalSetting->img_sm : asset('assets/images/not_found.jpg') }}"
                                        class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                </div>

                                <form action="{{ route('app.settings.upload-sm',$generalSetting->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="">Upload Logo 1</label>
                                        <input type="file" name="img_sm" id="img_sm">
                                    </div>

                                    <button type="submit" class="btn btn-sm btn-success"><i class="fe-upload"></i>
                                        Upload</button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <div class="text-center mb-4">
                                    <img src="{{ $generalSetting->img_lg != null ? asset('storage/public/img').'/'.$generalSetting->img_lg : asset('assets/images/not_found.jpg') }}"
                                        class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                </div>

                                <form action="{{ route('app.settings.upload-lg',$generalSetting->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="">Upload Logo 2</label>
                                        <input type="file" name="img_lg" id="img_lg">
                                    </div>

                                    <button type="submit" class="btn btn-sm btn-success"><i class="fe-upload"></i>
                                        Upload</button>
                                </form>
                            </div>
                        </div>
                        <hr>

                        <div class="text-center mb-4">
                            <img src="{{ $generalSetting->img_user != null ? asset('storage/public/img').'/'.$generalSetting->img_user : asset('assets/images/not_found.jpg') }}"
                                class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                        </div>

                        <form action="{{ route('app.settings.upload-user',$generalSetting->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Upload Logo 3</label>
                                <input type="file" name="img_user" id="img_user">
                            </div>

                            <button type="submit" class="btn btn-sm btn-success"><i class="fe-upload"></i>
                                Upload</button>
                        </form>
                        <hr>
                        <div class="text-center mb-4">
                            <img src="{{ $generalSetting->img_nota != null ? asset('storage/public/img').'/'.$generalSetting->img_nota : asset('assets/images/not_found.jpg') }}"
                                class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                        </div>
                        <form action="{{ route('app.settings.upload-nota',$generalSetting->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Upload Logo 4</label>
                                <input type="file" name="img_nota" id="img_nota">
                            </div>

                            <button type="submit" class="btn btn-sm btn-success"><i class="fe-upload"></i>
                                Upload</button>
                        </form>
                        <hr>
                        <div class="text-center mb-4">
                            <img src="{{ $generalSetting->img_fav != null ? asset('storage/public/img').'/'.$generalSetting->img_fav : asset('assets/images/not_found.jpg') }}"
                                class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                        </div>

                        <form action="{{ route('app.settings.upload-fav',$generalSetting->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Upload logo favicon</label>
                                <input type="file" name="img_fav" id="img_fav">
                            </div>

                            <button type="submit" class="btn btn-sm btn-success"><i class="fe-upload"></i>
                                Upload</button>
                        </form>

                    </div>
                </div> <!-- end card-box -->
            </div>

        </div> <!-- container -->
    </div> <!-- content -->
</div> <!-- content -->

@endsection

@include('backend.settings.includes.index-js')