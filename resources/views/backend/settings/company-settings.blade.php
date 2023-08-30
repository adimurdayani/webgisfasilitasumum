@extends('layouts.backend.admin')
@section('title',__('Company Settings'))

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
                            <li class="breadcrumb-item"><a href="{{ route('app.dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('app.settings.index') }}">
                                    {{__('General Settings')}}
                                </a></li>
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
                        @yield('title')
                    </div>
                    <div class="ribbon-content">
                        <div class="table-responsive">
                            <table class="table table-centered table-borderless table-striped mb-0">
                                <tbody>
                                    <tr>
                                        <td>{{__('App Name')}}</td>
                                        <td><a href="#" class="inline-username" data-name="app_name" data-type="text"
                                                data-pk="{{ $generalSetting->id != null ? $generalSetting->id : '' }}"
                                                data-title="Enter company name">
                                                {{ $generalSetting->app_name != null ?
                                                $generalSetting->app_name : '' }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 35%;">{{__('Author')}}</td>
                                        <td>
                                            <a href="#" class="inline-username" data-name="author" data-type="text"
                                                data-pk="{{ $generalSetting->id != null ? $generalSetting->id : '' }}"
                                                data-title="Enter nama lengkap">
                                                {{ $generalSetting->author != null ? $generalSetting->author : '' }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Email Address')}}</td>
                                        <td><a href="#" class="inline-username" data-name="email" data-type="email"
                                                data-pk="{{ $generalSetting->id != null ? $generalSetting->id : '' }}"
                                                data-title="Enter email address">
                                                {{ $generalSetting->email != null ? $generalSetting->email : '' }}
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{__('Phone')}}</td>
                                        <td><a href="#" class="inline-username" data-name="phone" data-type="text"
                                                data-pk="{{ $generalSetting->id != null ? $generalSetting->id : '' }}"
                                                data-title="Enter phone">
                                                {{ $generalSetting->phone != null ? $generalSetting->phone : '' }}
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{__('Alamat')}}</td>
                                        <td><a href="#" class="inline-username" data-name="address" data-type="text"
                                                data-pk="{{ $generalSetting->id != null ? $generalSetting->id : '' }}"
                                                data-title="Enter alamat">
                                                {{ $generalSetting->address != null ? $generalSetting->address : '' }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('City')}}</td>
                                        <td><a href="#" class="inline-username" data-name="city" data-type="text"
                                                data-pk="{{ $generalSetting->id != null ? $generalSetting->id : '' }}"
                                                data-title="Enter alamat">
                                                {{ $generalSetting->city != null ? $generalSetting->city : '' }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Province')}}</td>
                                        <td><a href="#" class="inline-username" data-name="province" data-type="text"
                                                data-pk="{{ $generalSetting->id != null ? $generalSetting->id : '' }}"
                                                data-title="Enter alamat">
                                                {{ $generalSetting->province != null ? $generalSetting->province : '' }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Country')}}</td>
                                        <td><a href="#" class="inline-username" data-name="country" data-type="text"
                                                data-pk="{{ $generalSetting->id != null ? $generalSetting->id : '' }}"
                                                data-title="Enter alamat">
                                                {{ $generalSetting->country != null ? $generalSetting->country : '' }}
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{__('Tax Number')}}</td>
                                        <td><a href="#" class="inline-username" data-name="tax_number" data-type="text"
                                                data-pk="{{ $generalSetting->id != null ? $generalSetting->id : '' }}"
                                                data-title="Enter alamat">
                                                {{ $generalSetting->tax_number != null ? $generalSetting->tax_number :
                                                '' }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('About Site')}}</td>
                                        <td><a href="#" class="inline-username" data-name="about_site" data-type="text"
                                                data-pk="{{ $generalSetting->id != null ? $generalSetting->id : '' }}"
                                                data-title="Enter alamat">
                                                {{ $generalSetting->about_site != null ? $generalSetting->about_site :
                                                '' }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Copyright Text')}}</td>
                                        <td><a href="#" class="inline-username" data-name="copyright_text"
                                                data-type="text"
                                                data-pk="{{ $generalSetting->id != null ? $generalSetting->id : '' }}"
                                                data-title="Enter alamat">
                                                {{ $generalSetting->copyright_text != null ?
                                                $generalSetting->copyright_text
                                                : '' }}
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{__('Website')}}</td>
                                        <td><a href="#" class="inline-username" data-name="link_website"
                                                data-type="text"
                                                data-pk="{{ $generalSetting->id != null ? $generalSetting->id : '' }}"
                                                data-title="Enter website">
                                                {{ $generalSetting->link_website != null ? $generalSetting->link_website
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

@include('backend.settings.includes.company-js')