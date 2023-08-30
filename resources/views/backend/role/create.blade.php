@extends('layouts.backend.admin')
@section('title','Form Role')

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
                            <li class="breadcrumb-item"><a href="{{ route('app.roles.index') }}">{{ __('List Roles')
                                    }}</a>
                            </li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@yield('title')</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <form action="{{ route('app.roles.post') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box ribbon-box">
                        <div class="ribbon ribbon-blue float-left"><i class="mdi mdi-plus mr-1"></i>
                            {{ __('Create New Role') }}
                        </div>

                        <div class="float-right mt-0">
                            <a href="{{ route('app.roles.index') }}" class="text-secondary btn-rounded"><i
                                    class="fe-list"></i>
                                {{ __('List Role') }}</a>
                        </div>

                        <div class="ribbon-content">
                            <div class="form-group mb-4">
                                <label for="name">{{ __('Name') }} <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" placeholder="Enter name"
                                    class="form-control @error('name') is-invalid @enderror">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="description">{{ __('Description') }} </label>
                                <textarea name="description" id="description" cols="30" rows="5" class="form-control"
                                    placeholder="Enter description"></textarea>
                            </div>

                        </div>

                    </div> <!-- end card-box -->
                </div>

            </div> <!-- container -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box ribbon-box">
                        <div class="ribbon ribbon-blue float-left"><i class="mdi mdi-plus mr-1"></i>
                            {{ __('Manage Permission for Role') }}
                        </div>
                        <div class="float-right mt-0">
                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="select-all">
                                <label class="custom-control-label" for="select-all">Select All</label>
                            </div>
                        </div>
                        <div class="ribbon-content">

                            @error('permissions')
                            <div class="alert alert-danger alert-dismissible fade show mb-3 mt-3" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ $message }}
                            </div>
                            @enderror
                            @forelse ($modules->chunk(4) as $key => $chunk)

                            <div class="form-row">
                                @foreach ($chunk as $key => $module)

                                <div class="col">
                                    <h4 class="header-title mt-5 mt-sm-0">{{ $module->name }}</h4>

                                    @foreach ($module->permissions as $permission)
                                    <div class="mt-3">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox" class="custom-control-input"
                                                id="permission-{{ $permission->id }}" name="permissions[]"
                                                value="{{ $permission->id }}">
                                            <label class="custom-control-label"
                                                for="permission-{{ $permission->id }}">{{
                                                $permission->name }}</label>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                                @endforeach
                            </div>


                            @empty
                            <div class="row">
                                <div class="col text-center">
                                    <strong>No module found!</strong>
                                </div>
                            </div>
                            @endforelse
                        </div>

                        <div class="text-right">
                            <button class="btn btn-rounded btn-blue" type="submit"><i class="fe-save"></i> Save
                                Role</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div> <!-- content -->
</div> <!-- content -->

@endsection

@include('backend.role.includes.add-js')