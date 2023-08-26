@extends('layouts.backend.admin')
@section('title',__('Edit Category'))

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
                            <li class="breadcrumb-item">
                                <a href="{{ route('app.dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('app.categories.index') }}">{{ __('List Category') }}</a>
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
            <div class="col-lg-6">
                <div class="card-box ribbon-box">
                    <div class="ribbon ribbon-warning float-left mb-4"><i class="fe-edit mr-1"></i>
                        @yield('title')</div>
                    <div class="float-right mb-4 mt-0">
                        <a href="{{ route('app.categories.index') }}" class="text-secondary"><i
                                class="mdi mdi-view-list"></i>
                            {{ __('List Category') }}</a>
                    </div>
                    <div class="ribbon-content">

                        <form action="{{ route('app.categories.update',$categorie->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="title">{{ __('Title') }} <span class="text-danger">*</span></label>
                                <input type="text" name="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    value="{{ $categorie->title }}">

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="keywords">{{ __('Keywords') }}</label>
                                <input type="text" name="keywords" class="form-control"
                                    value="{{ $categorie->keywords }}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="description">{{ __('Description') }}</label>
                                <textarea name="description"
                                    class="form-control">{{ $categorie->description }}</textarea>
                            </div>

                            <h4 class="header-title mt-5 mt-sm-0">{{ __('Status') }}</h4>
                            <div class="mt-3 mb-3">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" name="is_active" value="1" {{
                                        $categorie->is_active == true ? 'checked' : '' }}
                                    class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">{{ __('Active') }}
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="is_active" value="0" {{
                                        $categorie->is_active == false ? 'checked' : '' }} class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">{{ __('Non-Active')
                                        }}</label>
                                </div>
                            </div>

                            <<<<<<< HEAD <button type="submit" class="btn btn-sm btn-warning"><i class="fe-save"></i> {{
                                __('Save
                                Changes') }}</button>
                                =======
                                <button type="submit" class="btn btn-sm btn-warning"><i class="fe-save"></i>
                                    {{ __('Save Changes') }}</button>
                                >>>>>>> ca68f19 (update controller)

                        </form>
                    </div>
                </div> <!-- end card-box -->
            </div>

        </div> <!-- container -->

    </div> <!-- content -->
</div> <!-- content -->

@endsection
@include('backend.categories.includes.js.edit-js')