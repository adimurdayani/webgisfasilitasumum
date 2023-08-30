@extends('layouts.backend.admin')
@section('title',__('User Management'))

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
                            <li class="breadcrumb-item"><a href="{{ route('app.dashboard') }}">{{ __('Dashboard') }}</a></li>
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
                    <div class="ribbon ribbon-blue float-left mb-3"><i class="mdi mdi-database mr-1"></i>
                        Data Table Users
                    </div>
                    <h5 class="text-blue float-right mt-0">
                        <a href="{{ route('app.users.create') }}"><i class="mdi mdi-plus"></i> {{ __('Create User') }}</a>
                    </h5>

                    <div class="table-responsive">
                        <table class="table table-striped w-100" id="table-user">
                            <thead>
                                <tr>
                                    <th style="width: 0px;"></th>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">{{ __('Nama') }}</th>
                                    <th class="text-center">{{ __('Email') }}</th>
                                    <th class="text-center">{{ __('Status') }}</th>
                                    <th class="text-center"></th>
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

@endsection

@include('backend.user.includes.js.index-js')