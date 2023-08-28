@extends('layouts.backend.admin')
@section('title',__('Category'))
@push('page-css')
<link href="{{ asset('assets') }}/libs/x-editable/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet"
    type="text/css" />
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
            <div class="col-lg-12">
                <div class="card-box ribbon-box">
                    <div class="ribbon ribbon-blue float-left mb-4"><i class="mdi mdi-database mr-1"></i>
                        {{ __('Data Table') }} @yield('title')</div>

                    <h5 class="text-blue float-right mb-4 mt-0">
                        <a href="#" data-toggle="modal" data-target="#tambah"><i class="mdi mdi-plus"></i>
                            {{ __('Add') }} @yield('title')
                        </a>
                    </h5>

                    <div class="table-responsive">
                        <table class="table table-striped w-100" id="table-category">
                            <thead>
                                <tr>
                                    <th style="width: 0px"></th>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">{{ __('Title') }}</th>
                                    <th class="text-center">{{ __('Slug') }}</th>
                                    <th class="text-center">{{ __('Description') }}</th>
                                    <th class="text-center">{{ __('Status') }}</th>
                                    <th class="text-center">{{ __('Added Date') }}</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div> <!-- end card-box -->
            </div>

        </div> <!-- container -->

    </div> <!-- content -->
</div> <!-- content -->
@include('backend.categories.includes.modal.add-modal')
@endsection
@include('backend.categories.includes.js.index-js')