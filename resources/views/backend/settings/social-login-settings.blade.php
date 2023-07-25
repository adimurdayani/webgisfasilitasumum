@extends('layouts.backend.admin')
@section('title','Social Login Settings')

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
                            <li class="breadcrumb-item"><a href="{{ route('app.settings.index') }}">General
                                    Settings</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@yield('title')</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">

            @include('backend.settings.side-menu')

            <div class="col-lg-8">
                <div class="card-box ribbon-box">
                    <div class="ribbon ribbon-blue float-left mb-3"><i class="mdi mdi-facebook mr-1"></i>
                        Facebook Login Settings
                    </div>
                    <div class="ribbon-content">
                        @if (socialLogin(1))
                        <form action="{{ route('app.settings.update-social-login',socialLogin(1)) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group mb-2">
                                <label for="">Facebook Clent ID</label>
                                <input type="text" name="fb_client_id"
                                    class="form-control @error('fb_client_id') is-invalid @enderror"
                                    value="{{ socialLogin(1)->fb_client_id }}" placeholder="Enter facebook client id">

                                @error('fb_client_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label for="">Facebook Clent Secretkey</label>
                                <input type="text" name="fb_client_secret_key"
                                    class="form-control @error('fb_client_secret_key') is-invalid @enderror"
                                    value="{{ socialLogin(1)->fb_client_secret_key }}"
                                    placeholder="Enter facebook client id">

                                @error('fb_client_secret_key')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label>Facebook Visibility</label>
                            <div class="form-inline mb-4">
                                <div class="custom-control custom-radio mr-4">
                                    <input type="radio" id="customRadio1" name="fb_is_active" value="1" {{
                                        socialLogin(1)->fb_is_active == true ? 'checked' : '' }}
                                    class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Show</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="fb_is_active" value="0" {{
                                        socialLogin(1)->fb_is_active == false ? 'checked' : '' }}
                                    class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">Hide</label>
                                </div>
                            </div>

                    </div>
                    <hr>
                    <div class="ribbon-content">
                        <div class="form-group mb-2">
                            <label for="">Google Clent ID</label>
                            <input type="text" name="g_client_id"
                                class="form-control @error('g_client_id') is-invalid @enderror"
                                value="{{ socialLogin(1)->g_client_id }}" placeholder="Enter git client id">

                            @error('g_client_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="">Google Clent Secretkey</label>
                            <input type="text" name="g_client_secret_key"
                                class="form-control @error('g_client_secret_key') is-invalid @enderror"
                                value="{{ socialLogin(1)->g_client_secret_key }}" placeholder="Enter git client id">

                            @error('g_client_secret_key')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <label>Google Visibility</label>
                        <div class="form-inline mb-4">
                            <div class="custom-control custom-radio mr-4">
                                <input type="radio" id="customRadio3" name="g_is_active" value="1" {{
                                    socialLogin(1)->g_is_active ==
                                true ? 'checked' : '' }}
                                class="custom-control-input">
                                <label class="custom-control-label" for="customRadio3">Show</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio4" name="g_is_active" value="0" {{
                                    socialLogin(1)->g_is_active ==
                                false ? 'checked' : '' }}
                                class="custom-control-input">
                                <label class="custom-control-label" for="customRadio4">Hide</label>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="ribbon-content">
                        <div class="form-group mb-2">
                            <label for="">Github Clent ID</label>
                            <input type="text" name="git_client_id"
                                class="form-control @error('git_client_id') is-invalid @enderror"
                                value="{{ socialLogin(1)->git_client_id }}" placeholder="Enter git client id">

                            @error('git_client_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="">Github Clent Secretkey</label>
                            <input type="text" name="git_client_secret_key"
                                class="form-control @error('git_client_secret_key') is-invalid @enderror"
                                value="{{ socialLogin(1)->git_client_secret_key }}" placeholder="Enter git client id">

                            @error('git_client_secret_key')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <label>Github Visibility</label>
                        <div class="form-inline mb-4">
                            <div class="custom-control custom-radio mr-4">
                                <input type="radio" id="customRadio5" name="git_is_active" value="1" {{
                                    socialLogin(1)->git_is_active
                                == true ? 'checked' : '' }}
                                class="custom-control-input">
                                <label class="custom-control-label" for="customRadio5">Show</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio6" name="git_is_active" value="0" {{
                                    socialLogin(1)->git_is_active
                                == false ? 'checked' : '' }}
                                class="custom-control-input">
                                <label class="custom-control-label" for="customRadio6">Hide</label>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-sm btn-rounded btn-blue"><i class="fe-save"></i>
                                Save Changes</button>
                        </div>

                        </form>
                        @endif
                    </div>

                </div> <!-- end card-box -->
            </div>
        </div> <!-- container -->
    </div> <!-- content -->
</div> <!-- content -->

@endsection

@include('backend.settings.includes.social-js')