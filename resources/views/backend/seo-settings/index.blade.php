@extends('layouts.backend.admin')
@section('title',__('SEO Settings'))

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
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-right mb-2">
                                <a href="{{ route('app.sitemaps.index') }}" class="btn btn-sm btn-rounded btn-blue"
                                    target="_blank">{{ __('Go to Sitemap') }}</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-centered table-borderless table-striped mb-0">
                                    <tbody>
                                        <tr>
                                            <td>{{ __('SEO Title') }}</td>
                                            <td><a href="#" class="inline-username" data-name="seo_title"
                                                    data-type="text"
                                                    data-pk="{{ $seo_setting->id != null ? $seo_setting->id : '' }}"
                                                    data-title="Enter seo title">
                                                    {{ $seo_setting->seo_title != null ?
                                                    $seo_setting->seo_title : '' }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 35%;">{{ __('SEO Keywords') }}</td>
                                            <td>
                                                <a href="#" class="inline-username" data-name="seo_keywords"
                                                    data-type="text"
                                                    data-pk="{{ $seo_setting->id != null ? $seo_setting->id : '' }}"
                                                    data-title="Enter seo keywords">
                                                    {{ $seo_setting->seo_keywords != null ? $seo_setting->seo_keywords :
                                                    '' }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 35%;">{{ __('SEO Meta Description') }}</td>
                                            <td>
                                                <a href="#" class="inline-username" data-name="seo_meta_description"
                                                    data-type="text"
                                                    data-pk="{{ $seo_setting->id != null ? $seo_setting->id : '' }}"
                                                    data-title="Enter meta description">
                                                    {{ $seo_setting->seo_meta_description != null ?
                                                    $seo_setting->seo_meta_description :
                                                    '' }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 35%;">{{ __('Author Name') }}</td>
                                            <td>
                                                <a href="#" class="inline-username" data-name="author_name"
                                                    data-type="text"
                                                    data-pk="{{ $seo_setting->id != null ? $seo_setting->id : '' }}"
                                                    data-title="Enter author name">
                                                    {{ $seo_setting->author_name != null ? $seo_setting->author_name :
                                                    '' }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 35%;">{{ __('OG Title') }}</td>
                                            <td>
                                                <a href="#" class="inline-username" data-name="og_title"
                                                    data-type="text"
                                                    data-pk="{{ $seo_setting->id != null ? $seo_setting->id : '' }}"
                                                    data-title="Enter og title">
                                                    {{ $seo_setting->og_title != null ? $seo_setting->og_title :
                                                    '' }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 35%;">{{ __('OG Description') }}</td>
                                            <td>
                                                <a href="#" class="inline-username" data-name="og_description"
                                                    data-type="text"
                                                    data-pk="{{ $seo_setting->id != null ? $seo_setting->id : '' }}"
                                                    data-title="Enter og description">
                                                    {{ $seo_setting->og_description != null ?
                                                    $seo_setting->og_description :
                                                    '' }}
                                                </a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div> <!-- end .table-responsive -->
                            <hr>

                            <form action="{{ route('app.seo-setting.update',$seo_setting->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-3">
                                    <label for="goggle_analytics_id">{{ __('Google Analytics ID') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="goggle_analytics_id" id="goggle_analytics_id"
                                        value="{{ $seo_setting->goggle_analytics_id == null ? '' : $seo_setting->goggle_analytics_id }}"
                                        class="form-control" placeholder="Enter google analytics id">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="addthis_script">{{ __('AddThis Script') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="addthis_script" id="addthis_script"
                                        value="{{ $seo_setting->addthis_script == null ? '' : $seo_setting->addthis_script }}"
                                        class="form-control" placeholder="Enter add this script">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="addthis_toolbox_code">{{ __('AddThis Toolbox Code') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="addthis_toolbox_code" id="addthis_toolbox_code"
                                        value="{{ $seo_setting->addthis_toolbox_code == null ? '' : $seo_setting->addthis_toolbox_code }}"
                                        class="form-control" placeholder="Enter add this toolbox code">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="costum_js">{{ __('Costum JS') }}</label>
                                    <textarea name="costum_js" id="costum_js" cols="30" rows="10"
                                        class="form-control">{{ $seo_setting->costum_js == null ? '' : $seo_setting->costum_js }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-sm btn-success"><i class="fe-save"></i>
                                    {{ __('Update') }}</button>
                            </form>
                        </div>
                    </div>
                </div> <!-- end card-box -->
            </div>

            <div class="col-lg-4">
                <div class="card-box">
                    <h4 class="header-title mb-3">{{ __('OG Image') }}</h4>
                    <div class="text-center mb-4">
                        <img src="{{ $seo_setting->og_img != null ? asset('storage/public/img').'/'.$seo_setting->og_img : asset('assets/images/not_found.jpg') }}"
                            class="img-thumbnail" alt="profile-image">
                    </div>

                    <form action="{{ route('app.seo-setting.upload',$seo_setting->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="">{{ __('OG Image') }}</label>
                            <input type="file" name="og_img" id="og_img">
                        </div>

                        <button type="submit" class="btn btn-sm btn-success"><i class="fe-upload"></i>
                            {{ __('Upload') }}</button>
                    </form>
                </div>
            </div>
        </div> <!-- container -->

    </div> <!-- content -->
</div> <!-- content -->

@endsection

@include('backend.seo-settings.includes.index-js')