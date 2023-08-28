@extends('layouts.backend.admin')
@section('title',__('Permission'))

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
                    <div class="ribbon ribbon-blue float-left mb-3"><i class="mdi mdi-database mr-1"></i>
                        Data Table Permissions
                    </div>
                    <h5 class="text-blue mt-0 float-right"><a href="javascript:void(0);" data-target="#tambah"
                            data-toggle="modal"><i class="mdi mdi-plus"></i> Create
                            Permission</a></h5>

                    <div class="ribbon-content table-responsive">
                        <table class="table table-striped w-100" id="table-permission">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">{{__('Name')}}</th>
                                    <th class="text-center">{{__('Slug')}}</th>
                                    <th class="text-center">{{__('Created At')}}</th>
                                    <th class="text-center">{{__('Action')}}</th>
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

@include('backend.permission.includes.modal.modal')

@endsection

@include('backend.permission.includes.js.index-js')