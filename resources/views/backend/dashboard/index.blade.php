@extends('layouts.backend.admin')
@section('title',__('Dashboard'))

@push('page-css')
<link href="{{ asset('assets') }}/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets') }}/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')

<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">{{ __('Dashboard') }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-primary border-primary border shadow">
                                <i class="fe-eye font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="mt-1"><span data-plugin="counterup">{{ number_format(visits(),0) }}</span>
                                </h3>
                                <p class="text-muted mb-1 text-truncate">{{__('Total Visits')}}</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-success border-success border shadow">
                                <i class="fe-user font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{
                                        number_format(user(),0) }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">{{__('Total Users')}}</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-info border-info border shadow">
                                <i class="mdi mdi-newspaper font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{
                                        number_format(post('publish'),0) }}</span>
                                </h3>
                                <p class="text-muted mb-1 text-truncate">{{__('Post Publish')}}</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-warning border-warning border shadow">
                                <i class="fe-image font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ number_format(galery())
                                        }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">{{ __('Total Galery') }}</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->

        <div class="row">
            <div class="col-lg-4">
                <div class="card-box">

                    <h4 class="header-title mb-0">{{ __('Browsers') }}</h4>

                    <div id="cardCollpase18" class="collapse pt-3 show" dir="ltr">
                        <div id="apex-pie-1" class="apex-charts" data-colors="#6658dd,#4fc6e1,#4a81d4,#00b19d,#f1556c">
                        </div>
                    </div> <!-- collapsed end -->
                </div> <!-- end card-box -->
            </div> <!-- end col-->

            <div class="col-lg-8">
                <div class="card-box pb-2">

                    <h4 class="header-title mb-3">{{ __('Visit vs Visitor') }}</h4>

                    <div dir="ltr">
                        <div id="sales-analytics" class="mt-4" data-colors="#1abc9c,#5c6bc0"></div>
                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col-->
        </div>
        <!-- end row -->

    </div> <!-- container -->

</div> <!-- content -->

@endsection

@include('backend.dashboard.includes.index-js')