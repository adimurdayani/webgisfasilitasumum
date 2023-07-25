@extends('layouts.backend.admin')
@section('title','reCaptcha Settings')

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
                        reCaptcha Settings
                    </div>
                    <div class="ribbon-content">
                        <div class="table-responsive">
                            <table class="table table-centered table-borderless table-striped mb-0">
                                <tbody>
                                    <tr>
                                        <td>Captcha Secret</td>
                                        <td><a href="#" class="inline-username" data-name="captcha_secret"
                                                data-type="text"
                                                data-pk="{{ $generalSetting->id != null ? $generalSetting->id : '' }}"
                                                data-title="Enter captcha secret">
                                                {{ $generalSetting->captcha_secret != null ?
                                                $generalSetting->captcha_secret : '' }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 35%;">Captcha Sitekey</td>
                                        <td>
                                            <a href="#" class="inline-username" data-name="captcha_site_key"
                                                data-type="text"
                                                data-pk="{{ $generalSetting->id != null ? $generalSetting->id : '' }}"
                                                data-title="Enter captcha site key">
                                                {{ $generalSetting->captcha_site_key != null ?
                                                $generalSetting->captcha_site_key
                                                : '' }}
                                            </a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                            <form action="{{ route('app.settings.recaptcha-update',$generalSetting->id) }}"
                                method="post">
                                @csrf
                                @method('PUT')
                                <h4 class="header-title mt-3">Status</h4>
                                <div class="mt-3 form-inline mb-4">
                                    <div class="custom-control custom-radio mr-4">
                                        <input type="radio" id="customRadio1" name="captcha_is_active" value="1" {{
                                            $generalSetting->captcha_is_active == true ? 'checked' : '' }}
                                        class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio1">Show</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio2" value="0" name="captcha_is_active" {{
                                            $generalSetting->captcha_is_active == false ? 'checked' : '' }}
                                        class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio2">Hide</label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-sm btn-rounded btn-blue mt-2"><i
                                        class="fe-save"></i> Save Changes</button>
                            </form>

                        </div> <!-- end .table-responsive -->
                    </div>
                </div> <!-- end card-box -->
            </div>
        </div> <!-- container -->
    </div> <!-- content -->
</div> <!-- content -->

@endsection

@include('backend.settings.includes.recaptcha-js')