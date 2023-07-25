@extends('layouts.backend.admin')
@section('title','Social Settings')

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
                    <div class="ribbon ribbon-blue float-left mb-3"><i class="mdi mdi-globe-light mr-1"></i>
                        Social Settings
                    </div>
                    <div class="ribbon-content">
                        <div class="table-responsive">
                            <table class="table table-centered table-borderless table-striped mb-0">
                                <tbody>
                                    <tr>
                                        <td>Facebook</td>
                                        <td><a href="#" class="inline-username" data-name="link_facebook"
                                                data-type="text"
                                                data-pk="{{ $generalSetting->id != null ? $generalSetting->id : '' }}"
                                                data-title="Enter link facebook">
                                                {{ $generalSetting->link_facebook != null ?
                                                $generalSetting->link_facebook :
                                                '' }}
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Instagram</td>
                                        <td><a href="#" class="inline-username" data-name="link_instagram"
                                                data-type="text"
                                                data-pk="{{ $generalSetting->id != null ? $generalSetting->id : '' }}"
                                                data-title="Enter link instagram">
                                                {{ $generalSetting->link_instagram != null ?
                                                $generalSetting->link_instagram
                                                :
                                                '' }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Twitter</td>
                                        <td><a href="#" class="inline-username" data-name="link_twitter"
                                                data-type="text"
                                                data-pk="{{ $generalSetting->id != null ? $generalSetting->id : '' }}"
                                                data-title="Enter .ink twitter">
                                                {{ $generalSetting->link_twitter != null ? $generalSetting->link_twitter
                                                :
                                                '' }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Whatsapp</td>
                                        <td><a href="#" class="inline-username" data-name="link_whatsapp"
                                                data-type="text"
                                                data-pk="{{ $generalSetting->id != null ? $generalSetting->id : '' }}"
                                                data-title="Enter link whatsapp">
                                                {{ $generalSetting->link_whatsapp != null ?
                                                $generalSetting->link_whatsapp
                                                :
                                                '' }}
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Youtube</td>
                                        <td><a href="#" class="inline-username" data-name="link_youtube"
                                                data-type="text"
                                                data-pk="{{ $generalSetting->id != null ? $generalSetting->id : '' }}"
                                                data-title="Enter link youtube">
                                                {{ $generalSetting->link_youtube != null ? $generalSetting->link_youtube
                                                :
                                                '' }}
                                            </a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div> <!-- end .table-responsive -->
                    </div>
                </div> <!-- end card-box -->
            </div>
        </div> <!-- container -->
    </div> <!-- content -->
</div> <!-- content -->

@endsection

@include('backend.settings.includes.social-setting-js')