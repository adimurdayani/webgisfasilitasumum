@extends('layouts.backend.admin')
@section('title','Form User')

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
                            <li class="breadcrumb-item"><a href="{{ route('app.users.index') }}">Roles</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@yield('title')</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <form action="{{ route('app.users.post') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box ribbon-box">
                        <div class="ribbon ribbon-blue float-left"><i class="mdi mdi-plus mr-1"></i>
                            Create New User
                        </div>

                        <div class="float-right mt-0">
                            <a href="{{ route('app.users.index') }}" class="text-secondary btn-rounded"><i
                                    class="fe-list"></i>
                                List User</a>
                        </div>

                        <div class="ribbon-content">
                            <div class="form-group">
                                <label for="name" class="control-label">Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    id="name" placeholder="Enter nama" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email" class="control-label">Email</label>
                                <input type="email" name="email"
                                    class="form-control @error('name') is-invalid @enderror" id="email"
                                    placeholder="Enter email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="control-label">Password</label>
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            placeholder="Enter password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="conf_password" class="control-label">Konfirmasi Password</label>
                                        <input type="password" name="conf_password"
                                            class="form-control @error('conf_password') is-invalid @enderror"
                                            id="conf_password" placeholder="Enter konfirmasi password">

                                        @error('conf_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="role_id" class="control-label">Role User</label>
                                <select name="role_id" id="role_id"
                                    class="form-control @error('role_id') is-invalid @enderror" data-toggle="select2">
                                    <option value="">-- Choose --</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>

                                @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <h4 class="header-title mt-3 mt-sm-0">Status</h4>
                            <div class="mt-2">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="status" value="1" id="status-1"
                                        class="custom-control-input" checked>
                                    <label class="custom-control-label" for="status-1">Active</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="status" value="0" id="status-2"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="status-2">Non-Active</label>
                                </div>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-rounded btn-blue mt-3"><i class="fe-save"></i>
                            Save</button>

                    </div> <!-- end card-box -->

                </div>

            </div> <!-- container -->
        </form>

    </div> <!-- content -->
</div> <!-- content -->

@endsection

@include('backend.user.includes.js.add-js')