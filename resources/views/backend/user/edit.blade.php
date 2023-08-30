@extends('layouts.backend.admin')
@section('title',$user->name)

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
                            <li class="breadcrumb-item"><a href="{{ route('app.users.index') }}">{{__('List User')}}</a>
                            </li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@yield('title')</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <form action="{{ route('app.users.update',$user->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box ribbon-box">

                        <div class="float-right mt-0">
                            <a href="{{ route('app.users.index') }}" class="text-secondary btn-rounded"><i
                                    class="fe-list"></i>
                                {{__('List User')}}</a>
                        </div>

                        <div class="ribbon-content">
                            <div class="form-group">
                                <label for="name" class="control-label">{{__('Name')}}</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ $user->name }}" id="name" placeholder="Enter nama" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email" class="control-label">{{__('Email')}}</label>
                                <input type="email" name="email"
                                    class="form-control @error('name') is-invalid @enderror" id="email"
                                    value="{{ $user->email }}" placeholder="Enter email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="control-label">{{__('Password')}}</label>
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
                                        <label for="conf_password" class="control-label">{{__('Confirmation
                                            Password')}}</label>
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
                                <label for="role_id" class="control-label">{{__('Role User')}}</label>
                                <select name="role_id" id="role_id"
                                    class="form-control @error('role_id') is-invalid @enderror" data-toggle="select2">
                                    <option value="">-- {{__('Choose')}} --</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : ''
                                        }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>

                                @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <h4 class="header-title mt-3 mt-sm-0">{{__('Status')}}</h4>
                            <div class="mt-2">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="status" value="1" id="status-1"
                                        class="custom-control-input" {{ $user->status == 1 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="status-1">{{__('Active')}}</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="status" value="0" id="status-2" {{ $user->status == 0 ?
                                    'checked' : '' }}
                                    class="custom-control-input">
                                    <label class="custom-control-label" for="status-2">{{__('Non-Active')}}</label>
                                </div>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-rounded btn-warning mt-4"><i class="fe-save"></i>
                            {{__('Save Change')}}</button>
                    </div> <!-- end card-box -->

                </div>

            </div> <!-- container -->
        </form>

    </div> <!-- content -->
</div> <!-- content -->

@endsection

@include('backend.user.includes.js.edit-js')