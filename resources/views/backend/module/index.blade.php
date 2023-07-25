@extends('layouts.backend.admin')
@section('title','Modules')

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
            <div class="col-lg-12">
                <div class="card-box ribbon-box">
                    <div class="ribbon ribbon-blue float-left mb-3"><i class="mdi mdi-plus mr-1"></i>
                        Data Table Modules
                    </div>
                    <h5 class="text-blue float-right mt-0"><a href="#" data-target="#tambah" data-toggle="modal"><i
                                class="mdi mdi-plus"></i> Create
                            Module</a></h5>

                    <div class="ribbon-content table-responsive">
                        <table class="table table-striped w-100" id="table-module">
                            <thead>
                                <tr>
                                    <th style="width: 0px;"></th>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Created At</th>
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

@include('backend.module.includes.modal.modal')

@endsection

@include('backend.module.includes.js.index-js')