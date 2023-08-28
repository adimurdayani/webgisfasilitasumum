@extends('layouts.backend.admin')
@section('title',__('List Posts'))

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
            <div class="col-lg-12">
                <div class="card-box ribbon-box">
                    <div class="ribbon ribbon-blue float-left mb-4"><i class="mdi mdi-database mr-1"></i> {{ __('Data
                        Tabel') }} @yield('title')</div>

                    <h5 class="text-blue float-right mb-4 mt-0">
                        <a href="{{ route('app.posts.create') }}"><i class="mdi mdi-plus"></i>
                            {{ __('Create New Article') }}</a>
                    </h5>

                    <h5 class="text-blue float-right mb-4 mt-0 mr-2">
                        <a href="{{ route('app.posts.create-video') }}"><i class="mdi mdi-plus"></i>
                            {{ __('Create New Video') }}</a>
                    </h5>

                    <div class="table-responsive">
                        <table class="table table-striped w-100" id="table-posts">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle" style="width: 25%;">{{ __('Post') }}</th>
                                    <th class="text-center align-middle">{{ __('Post Type') }}</th>
                                    <th class="text-center align-middle">{{ __('Category') }}</th>
                                    <th class="text-center align-middle" style="width: 10%;">{{ __('Visibility') }}</th>
                                    <th class="text-center align-middle">{{ __('Publish') }}</th>
                                    <th class="text-center align-middle">{{ __('View') }}</th>
                                    <th class="text-center align-middle">{{ __('Post By') }}</th>
                                    <th class="text-center align-middle">{{ __('Added Date') }}</th>
                                    <th class="text-center align-middle">{{ __('Action') }}</th>
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

@include('backend.post.includes.js.index-js')