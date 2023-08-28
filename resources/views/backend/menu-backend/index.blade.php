@extends('layouts.backend.admin')
@section('title',__('Menu Manajement'))

@push('page-css')
<link href="{{ asset('assets') }}/libs/nestable2/jquery.nestable.min.css" rel="stylesheet" />
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
            <div class="col-lg-12">
                <div class="card-box ribbon-box">
                    <div class="ribbon ribbon-blue float-left mb-4"><i class="mdi mdi-database mr-1"></i> {{ __('Data
                        Table') }}
                        @yield('title')</div>

                    <div class="float-right mb-4 mt-0">
                        <h5 class="text-blue"><a href="#" data-target="#tambah" data-toggle="modal"><i
                                    class="mdi mdi-plus"></i>
                                {{ __('Create New') }} @yield('title')
                            </a>
                        </h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped w-100" id="table-menu">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">{{ __('Name') }}</th>
                                    <th class="text-center">{{ __('Description') }}</th>
                                    <th class="text-center">{{ __('Deletable') }}</th>
                                    <th class="text-center">{{ __('Last Modified') }}</th>
                                    <th class="text-center">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div> <!-- end card-box -->
            </div>

        </div> <!-- container -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box ribbon-box">
                    <div class="ribbon ribbon-success float-left mb-4"><i class="mdi mdi-menu mr-1"></i> Menu
                        Builder</div>

                    <div class="float-right mb-4 mt-0">
                        <button type="button" data-target="#tambah-submenu" data-toggle="modal"
                            class="btn btn-success btn-rounded"><i class="mdi mdi-plus"></i>
                            Create Sub Menu</button>
                    </div>

                    <div class="ribbon-content">
                        <h4 class="header-title">Menu Structure</h4>

                        <div data-spy="scroll" data-target="#navbar-example3" data-offset="0" class="scrollspy-example"
                            style="height: 350px;">
                            <div class="custom-dd-empty dd" id="nestable_list_1">
                                <ol class="dd-list">
                                    @forelse ($menus as $m)
                                    <li class="dd-item dd3-item" data-id="{{ $m->id }}">
                                        <div class="dd3-content">
                                            {{ $m->name }}
                                        </div>

                                        <ol class="dd-list">
                                            @foreach ($m->subMenus as $sm)
                                            <li class="dd-item" data-id="{{ $sm->id }}">
                                                {{-- <div class="dd-handle dd3-handle"></div> --}}
                                                <div class="dd3-content">
                                                    {{ $sm->title }}
                                                    <a href="#"
                                                        class="badge badge-danger float-right ml-1 hapus-submenu"
                                                        data-id="{{ $sm->id }}"><i class="fe-trash"></i></a>
                                                    <a href="#" class="badge badge-warning float-right ml-1"
                                                        data-target="#edit-submenu{{ $sm->id }}" data-toggle="modal"><i
                                                            class="fe-edit"></i></a>
                                                    <a href="#" class="badge badge-blue float-right"
                                                        data-target="#tambah-menuitem{{ $sm->id }}"
                                                        data-toggle="modal"><i class="fe-plus"></i></a>
                                                </div>
                                                <ol class="dd-list">
                                                    @foreach ($sm->menuItems as $im)
                                                    <li class="dd-item" data-id="{{ $im->id }}">
                                                        <div class="dd3-content">
                                                            {{ $im->title }}

                                                            <a href="#"
                                                                class="badge badge-danger float-right ml-1 hapus-itemmenu"
                                                                data-id="{{ $im->id }}"><i class="fe-trash"></i></a>
                                                            <a href="#" class="badge badge-warning float-right ml-1"
                                                                data-target="#edit-menuitem{{ $im->id }}"
                                                                data-toggle="modal"><i class="fe-edit"></i></a>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ol>
                                            </li>
                                            @endforeach

                                        </ol>
                                    </li>
                                    @empty
                                    <div class="text-center">
                                        <strong>Data not found!.</strong>
                                    </div>
                                    @endforelse

                                </ol>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div> <!-- content -->
    </div> <!-- content -->

</div>

@include('backend.menu-backend.includes.modal.modal')

@endsection

@include('backend.menu-backend.includes.js.index-js')