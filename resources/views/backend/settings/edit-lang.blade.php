@extends('layouts.backend.admin')
@section('title',$language->name)
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
                            <li class="breadcrumb-item"><a href="{{ route('app.languages.index') }}">{{ __('List
                                    Language
                                    Setting') }}</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@yield('title')</h4>
                </div>
            </div>

        </div>
        <!-- end page title -->

        <form action="{{ route('app.countries.update',$language->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box ribbon-box">
                        <div class="ribbon ribbon-warning float-left mb-4"><i class="mdi mdi-translate mr-1"></i>
                            @yield('title')
                        </div>

                        <div class="float-right mb-4 mt-0">
                            <a href="{{ route('app.languages.index') }}" class="text-secondary"><i
                                    class="mdi mdi-view-list"></i>
                                {{ __('List Language Settings') }}</a>
                        </div>
                        <div class="ribbon-content">

                            <div class="form-group mb-3">
                                <label for="name">{{ __('Name') }} <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter name" value="{{ old('name') ?? $language->name }}" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="code">{{ __('Code') }} <span class="text-danger">*</span></label>
                                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                                    placeholder="en" value="{{ old('code') ?? $language->code }}">

                                @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="flag">{{ __('Flag Code') }} <span class="text-danger">*</span></label>
                                <select name="flag" id="flag" class="form-control @error('flag') is-invalid @enderror"
                                    data-toggle="select2">
                                    @foreach (countries() as $countryId => $name)
                                    <option value="{{ $countryId }}" {{ $language->flag == $countryId ? 'selected' : ''
                                        }}>{{ $name }}({{ $countryId }})</option>
                                    @endforeach
                                </select>

                                @error('flag')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <h4 class="header-title mt-5 mt-sm-0">{{ __('Status') }}</h4>
                            <div class="mt-3 mb-3">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" name="status" value="1" {{ $language->status
                                    == true ? 'checked':'' }}
                                    class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">{{ __('Active') }}</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="status" value="0"
                                        class="custom-control-input" {{ $language->status == false ? 'checked':'' }}>
                                    <label class="custom-control-label" for="customRadio2">{{ __('Inactive') }}</label>
                                </div>
                            </div>

                            <button type="submit" class="btn  btn-sm btn-warning"><i class="fe-save"></i> {{ __('Save
                                Changes') }}</button>
                        </div>
                    </div> <!-- end card-box -->

                </div>

            </div> <!-- container -->

        </form>

    </div> <!-- content -->
</div> <!-- content -->
@endsection
@include('backend.settings.includes.language-js')