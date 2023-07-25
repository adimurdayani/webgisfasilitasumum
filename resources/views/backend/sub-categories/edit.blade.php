@extends('layouts.backend.admin')
@section('title','Edit Sub Category')

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
                            <li class="breadcrumb-item"><a href="{{ route('app.subcategories.index') }}">Sub
                                    Category</a>
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
                    <div class="ribbon ribbon-warning float-left mb-4"><i class="fe-edit mr-1"></i> @yield('title')
                    </div>

                    <div class="float-right mb-4 mt-0">
                        <a href="{{ route('app.subcategories.index') }}" class="text-secondary"><i class="fe-list"></i>
                            Back to Sub Category</a>
                    </div>
                    <div class="ribbon-content">

                        <form action="{{ route('app.subcategories.update',$subCategorie->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="title">Title <span class="text-danger">*</span></label>
                                <select name="id_category" class="form-control" data-toggle="select2">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $subCategorie->id ?
                                        'selected'
                                        : '' }}>{{ $subCategorie->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="title">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    value="{{ $subCategorie->title }}">

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="keywords">Keywords</label>
                                <input type="text" name="keywords" class="form-control"
                                    value="{{ $subCategorie->keywords }}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="description">Description</label>
                                <textarea name="description"
                                    class="form-control">{{ $subCategorie->description }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-sm btn-warning"><i class="fe-save"></i> Save
                                Changes</button>

                        </form>
                    </div>
                </div> <!-- end card-box -->
            </div>

        </div> <!-- container -->

    </div> <!-- content -->
</div> <!-- content -->
@endsection

@include('backend.sub-categories.includes.js.edit-js')