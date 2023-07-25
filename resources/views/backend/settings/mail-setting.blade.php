@extends('layouts.backend.admin')
@section('title','Mail Settings')

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
                            <li class="breadcrumb-item"><a href="{{ route('app.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('app.settings.index') }}">General
                                    Settings</a></li>
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
                    <div class="ribbon ribbon-blue float-left mb-3"><i class="mdi mdi-home-city mr-1"></i>
                        Mail Settings
                    </div>
                    <div class="ribbon-content">
                        @isset($mail)
                        <form action="{{ route('app.mails.update',$mail->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="mail_mailer">Mail Mailer <span class="text-center">*</span></label>
                                        <input type="text" name="mail_mailer" id="mail_mailer"
                                            class="form-control @error('mail_mailer') is-invalid @enderror"
                                            value="{{ $mail->mail_mailer ?? old('mail_mailer') }}"
                                            placeholder="ex: smtp">

                                        @error('mail_mailer')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="mail_encryption">Mail Encryption <span
                                                class="text-center">*</span></label>
                                        <input type="text" name="mail_encryption" id="mail_encryption"
                                            class="form-control @error('mail_encryption') is-invalid @enderror"
                                            value="{{ $mail->mail_encryption ?? old('mail_encryption') }}"
                                            placeholder="ex: lts">

                                        @error('mail_encryption')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <label for="mail_host">Mail Host <span class="text-center">*</span></label>
                                <input type="text" name="mail_host" id="mail_host"
                                    class="form-control @error('mail_host') is-invalid @enderror"
                                    value="{{ $mail->mail_host ?? old('mail_host') }}" placeholder="Enter mail host">

                                @error('mail_host')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label for="mail_port">Mail Port <span class="text-center">*</span></label>
                                <input type="text" name="mail_port" id="mail_port"
                                    class="form-control @error('mail_port') is-invalid @enderror"
                                    value="{{ $mail->mail_port ?? old('mail_port') }}" placeholder="Enter mail port">

                                @error('mail_port')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="mail_username">Mail Username <span
                                                class="text-center">*</span></label>
                                        <input type="text" name="mail_username" id="mail_username"
                                            class="form-control @error('mail_username') is-invalid @enderror"
                                            value="{{ $mail->mail_username ?? old('mail_username') }}"
                                            placeholder="ex: smtp">

                                        @error('mail_username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="mail_password">Mail Password <span
                                                class="text-center">*</span></label>
                                        <input type="password" name="mail_password" id="mail_password"
                                            class="form-control @error('mail_password') is-invalid @enderror"
                                            value="{{ $mail->mail_password ?? old('mail_password') }}"
                                            placeholder="ex: lts">

                                        @error('mail_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <label for="mail_from_address">Mail From Address <span
                                        class="text-center">*</span></label>
                                <input type="text" name="mail_from_address" id="mail_from_address"
                                    class="form-control @error('mail_from_address') is-invalid @enderror"
                                    value="{{ $mail->mail_from_address ?? old('mail_from_address') }}"
                                    placeholder="Enter mail host">

                                @error('mail_from_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label for="mail_from_name">Mail Form Name <span class="text-center">*</span></label>
                                <input type="text" name="mail_from_name" id="mail_from_name"
                                    class="form-control @error('mail_from_name') is-invalid @enderror"
                                    value="{{ $mail->mail_from_name ?? old('mail_from_name') }}"
                                    placeholder="Enter mail port">

                                @error('mail_from_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-sm btn-blue btn-rounded mt-3"><i class="fe-save"></i>
                                Save Changes</button>

                        </form>
                        @endisset
                    </div>
                </div> <!-- end card-box -->
            </div>
        </div> <!-- container -->
    </div> <!-- content -->
</div> <!-- content -->

@endsection

@include('backend.settings.includes.mail-js')