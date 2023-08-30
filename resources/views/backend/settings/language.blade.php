@extends('layouts.backend.admin')
@section('title',__('Language Setting'))

@push('page-css')
<link href="{{ asset('assets') }}/libs/x-editable/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('assets/') }}/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/') }}/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
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

            @include('backend.settings.side-menu')

            <div class="col-lg-8">
                <div class="card-box ribbon-box">
                    <div class="ribbon ribbon-blue float-left mb-3"><i class="mdi mdi-translate mr-1"></i>
                        @yield('title')
                    </div>

                    <div class="float-right">
                        <a href="{{ route('app.countries.create') }}" class="btn btn-success mb-3">
                            <i class="mdi mdi-plus"></i> {{ __('Add Language') }}
                        </a>
                    </div>
                    <div class="ribbon-content">

                        <div class="table-responsive">
                            <table class="table table-bordered w-100" id="table-country">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Code') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Added On') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                        <hr>

                        <form method="POST" action="{{ route('app.languages.store') }}" class="mb-2">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="key"
                                        class="form-control @error('key') is-invalid @enderror"
                                        placeholder="Enter Key..." value="{{ old('key') }}">

                                    @error('key')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="value"
                                        class="form-control @error('value') is-invalid @enderror"
                                        placeholder="Enter Value..." value="{{ old('value') }}">

                                    @error('key')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success">{{ __('Add') }}</button>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>Key</th>

                                        @if($languages->count() > 0)

                                        @foreach($languages as $language)
                                        <th>{{ $language->name }}({{ $language->code }})</th>
                                        @endforeach

                                        @endif

                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($columnCount > 0)
                                    @foreach($columns[0] as $columnKey => $columnValue)
                                    <tr>
                                        <td>
                                            <a href="#" class="translate-key" data-title="Enter Key" data-type="text"
                                                data-pk="{{ $columnKey }}"
                                                data-url="{{ route('app.languages.transUpdateKey') }}">{{ $columnKey }}
                                            </a>
                                        </td>
                                        @for($i = 1; $i <= $columnCount; ++$i) <td>
                                            <a href="#" data-title="Enter Translate" class="translate"
                                                data-code="{{ $columns[$i]['lang'] }}" data-type="text"
                                                data-pk="{{ $columnKey }}"
                                                data-url="{{ route('app.languages.transUpdate') }}">
                                                {{ isset($columns[$i]['data'][$columnKey]) ?
                                                $columns[$i]['data'][$columnKey] : '' }}
                                            </a>
                                            </td>
                                            @endfor
                                            <td>
                                                <button data-action="{{ route('app.languages.destroy',$columnKey) }}"
                                                    class="btn btn-danger btn-xs remove-key">{{ __('Delete') }}</button>
                                            </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@include('backend.settings.includes.language-js')