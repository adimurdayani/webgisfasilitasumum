@extends('layouts.backend.admin')
@section('title','Profile')

@push('page-css')
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
@endpush

@section('content')

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
        <div class="col-lg-4 col-xl-4">
            <div class="card-box text-center">
                <img src="{{ Auth::user()->img_user == null ? asset('assets/images/not_found.jpg') : asset('storage/public/img/'.Auth::user()->img_user) }}"
                    class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

                <h4 class="mb-0">{{ Auth::user()->name }}</h4>
                <p class="text-muted">{{ Auth::user()->email }}</p>

                <div class="text-left mt-3">
                    <h4 class="font-13 text-uppercase">About Me :</h4>
                    <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ml-2">{{
                            Auth::user()->name }}</span></p>

                    <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2">{{ $config_web->phone
                            }}</span></p>

                    <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{
                            Auth::user()->email }}</span></p>

                    <p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ml-2">INDONESIA</span>
                    </p>
                </div>

                <ul class="social-list list-inline mt-3 mb-0">
                    <li class="list-inline-item">
                        <a href="{{ $config_web->link_facebook }}"
                            class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ $config_web->link_instagram }}"
                            class="social-list-item border-danger text-danger"><i class="mdi mdi-instagram"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ $config_web->link_twitter }}" class="social-list-item border-info text-info"><i
                                class="mdi mdi-twitter"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{$config_web->link_whatsapp }}"
                            class="social-list-item border-success text-success"><i class="mdi mdi-whatsapp"></i></a>
                    </li>
                </ul>
            </div> <!-- end card-box -->

        </div> <!-- end col-->

        <div class="col-lg-8 col-xl-8">
            <div class="card-box">
                <ul class="nav nav-pills navtab-bg nav-justified">
                    <li class="nav-item">
                        <a href="#settings" data-toggle="tab" aria-expanded="true" class="nav-link active">
                            Settings
                        </a>
                    </li>
                </ul>
                <div class="tab-content">

                    <div class="tab-pane  show active" id="settings">
                        <h5 class="mb-4 text-uppercase bg-light p-2"><i class="mdi mdi-image mr-1"></i> Image
                        </h5>

                        <form action="{{ route('app.profile.upload-img',Auth::user()->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Upload Foto</label>
                                <input type="file" name="img_user" id="img_user">
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-success waves-effect waves-light mb-2"><i
                                        class="fe-upload"></i>
                                    Upload</button>
                            </div>
                        </form>
                        <form method="POST" action="{{ route('app.profile.update',Auth::user()->id) }}">
                            @csrf
                            @method('PUT')

                            <h5 class="mb-4 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle mr-1"></i>
                                Personal Info
                            </h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ Auth::user()->name }}" autocomplete="off"
                                            placeholder="Enter nama lengkap">

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div> <!-- end row -->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" autocomplete="off" value="{{ Auth::user()->email }}"
                                            placeholder="Enter email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div> <!-- end row -->

                            <div class="text-right">
                                <button type="submit" class="btn btn-warning waves-effect waves-light mt-2 mb-2"><i
                                        class="mdi mdi-content-save"></i> Ubah</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('app.profile.password',Auth::user()->id) }}">
                            @csrf
                            @method('PUT')
                            <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building mr-1"></i>
                                Ubah Password</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            name="password" autocomplete="off" placeholder="Enter password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="konf_password">Konfirmasi Password</label>
                                        <input type="password"
                                            class="form-control @error('konf_password') is-invalid @enderror"
                                            id="konf_password" name="konf_password"
                                            placeholder="Enter konfirmasi password">

                                        @error('konf_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->

                            <div class="text-right">
                                <button type="submit" class="btn btn-danger waves-effect waves-light mt-2"><i
                                        class="mdi mdi-content-save"></i> Ubah</button>
                            </div>
                        </form>
                    </div>
                    <!-- end settings content-->

                </div> <!-- end tab-content -->
            </div> <!-- end card-box-->

        </div> <!-- end col -->
    </div>
    <!-- end row-->

</div> <!-- container -->

@endsection

@include('backend.profile.includes.index-js')