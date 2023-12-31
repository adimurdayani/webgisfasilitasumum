@extends('layouts.backend.admin')
@section('title','Sub Category')

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
                    <div class="ribbon ribbon-blue float-left mb-4"><i class="mdi mdi-database mr-1"></i> Data Tabel
                        @yield('title')</div>

                    <div>
                        <h5 class="text-blue float-right mb-4 mt-0">
                            <a href="#" data-toggle="modal" data-target="#tambah"><i class="mdi mdi-plus"></i>
                                Create Sub Category</a>
                        </h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped w-100" id="table-subcategory">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Slug</th>
                                    <th class="text-center">Parent Category</th>
                                    <th class="text-center">Added Date</th>
                                    <th class="text-center">Action</th>
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

@include('backend.sub-categories.includes.modal.modal')

@endsection

@include('backend.sub-categories.includes.js.index-js')