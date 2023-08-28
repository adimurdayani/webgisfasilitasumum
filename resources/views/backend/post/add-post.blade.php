@extends('layouts.backend.admin')
@section('title',__('Create New Article'))

@push('page-css')
<link href="{{ asset('assets') }}/filepond/filepond.css" rel="stylesheet" />
<link href="{{ asset('assets') }}/filepond/filepond-plugin-image-preview.css" rel="stylesheet" />

<link href="{{ asset('assets/') }}/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/') }}/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="{{ route('app.posts.index') }}">{{ __('List Post')
                                    }}</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@yield('title')</h4>
                </div>
            </div>

        </div>
        <!-- end page title -->

        @if (count($errors) > 0)
        @foreach ($errors->all() as $item)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ $item }}
        </div>
        @endforeach
        @endif

        <form action="{{ route('app.posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="card-box ribbon-box">
                        <div class="ribbon ribbon-blue float-left mb-4"><i class="mdi mdi-text-box mr-1"></i>
                            {{__('Content
                            Post')}}
                        </div>

                        <div class="float-right mb-4 mt-0">
                            <a href="{{ route('app.posts.index') }}" class="text-secondary"><i
                                    class="mdi mdi-view-list"></i>
                                {{__('List Posts')}}</a>
                        </div>
                        <div class="ribbon-content">

                            <div class="form-group mb-3">
                                <label for="title">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title"
                                    class="form-control @error('title') is-invalid @enderror" placeholder="Enter title"
                                    value="{{ old('title') }}" autofocus>

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="sub_title">Sub Title</label>
                                <input type="text" name="sub_title" class="form-control" placeholder="Enter sub title"
                                    value="{{ old('sub_title') }}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="content">Content <span class="text-danger">*</span></label>
                                <textarea name="content" id="content" cols="30" rows="20"
                                    class="form-control @error('content') is-invalid @enderror ckeditor">{!! old('content') !!}</textarea>

                                @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                    </div> <!-- end card-box -->

                    <div class="card-box ribbon-box">
                        <div class="ribbon ribbon-blue float-left mb-4"><i class="mdi mdi-view-list mr-1"></i>
                            Visibility
                        </div>
                        <div class="ribbon-content">
                            <h4 class="header-title mt-5 mt-sm-0">Status</h4>
                            <div class="mt-3 form-inline mb-4">
                                <div class="custom-control custom-radio mr-4">
                                    <input type="radio" id="customRadio1" name="is_active" value="1" checked
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Show</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="is_active" value="0"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">Hide</label>
                                </div>
                            </div>

                            <h4 class="header-title mt-5 mt-sm-0">Visibility</h4>
                            <div class="mt-3">
                                @foreach ($visibility as $v)
                                <div class="custom-control custom-checkbox mb-2">
                                    <input type="checkbox" class="custom-control-input" name="visibilitie_id[]"
                                        value="{{ $v->id }}" id="visibility-{{ $v->id }}">
                                    <label class="custom-control-label" for="visibility-{{ $v->id }}">{{ $v->title
                                        }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div> <!-- end card-box -->

                    <div class="card-box ribbon-box">
                        <div class="ribbon ribbon-blue float-left mb-4"><i class="mdi mdi-text-box-outline mr-1"></i>
                            SEO
                            Details
                        </div>
                        <div class="ribbon-content">
                            <div class="form-group mb-2">
                                <label for="meta_title">Title <span class="text-muted">(Meta Title)</span></label>
                                <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}"
                                    class="form-control @error('meta_title') is-invalid @enderror"
                                    placeholder="Enter meta title">

                                @error('meta_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meta_keywords">Keywords <span class="text-muted">(Meta
                                                Keywords)</span></label>
                                        <input type="text" name="meta_keywords" id="meta_keywords"
                                            value="{{ old('meta_keywords') }}"
                                            class="form-control @error('meta_keywords') is-invalid @enderror"
                                            placeholder="Enter meta title">

                                        @error('meta_keywords')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meta_tag">Tags <span class="text-muted">(Meta tag)</span></label>
                                        <input type="text" name="meta_tag" id="selectize-tags"
                                            class="form-control @error('meta_tag') is-invalid @enderror"
                                            value="{{ old('meta_tag') }}" placeholder="Enter meta tags">

                                        @error('meta_tag')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="meta_description">Description <span class="text-muted">(Meta
                                        Description)</span></label>
                                <textarea name="meta_description" rows="5" cols="30"
                                    class="form-control @error('meta_description') is-invalid @enderror"
                                    placeholder="Enter meta description">{!! old('meta_description') !!}</textarea>

                                @error('meta_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div> <!-- end card-box -->
                </div>
                <div class="col-lg-4">
                    <div class="card-box ribbon-box">
                        <div class="ribbon ribbon-blue float-left mb-4"><i class="mdi mdi-image-album mr-1"></i> Image
                        </div>
                        <div class="ribbon-content">
                            <div class="form-group mt-3 mb-2">
                                <label for="projectname" class="mb-0">Images <span class="text-danger">*</span></label>
                                <p class="text-muted font-14">Recommended images size 960x600 (px).</p>
                                <input type="file" name="image" id="image" required>
                            </div>

                            <div class="form-group">
                                <label for="image_description">Image Description <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="image_description"
                                    class="form-control @error('image_description') is-invalid @enderror"
                                    value="{{ old('image_description') }}" placeholder="Enter image description">

                                @error('image_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div> <!-- end card-box -->
                    <div class="card-box ribbon-box">
                        <div class="ribbon ribbon-blue float-left mb-4"><i class="mdi mdi-view-list mr-1"></i> Category
                        </div>
                        <div class="ribbon-content">
                            <div class="form-group mb-2">
                                <label for="categorie_id">Category</label>
                                <select name="categorie_id" id="categorie_id" class="form-control"
                                    data-toggle="select2">
                                    <option value="">-- Select --</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-2">
                                <label for="subcategorie_id">Sub Category</label>
                                <select name="subcategorie_id" class="form-control" data-toggle="select2"></select>
                            </div>
                        </div>
                    </div> <!-- end card-box -->

                    <div class="card-box ribbon-box">
                        <div class="ribbon ribbon-blue float-left mb-4"><i class="mdi mdi-publish mr-1"></i> Publish
                        </div>
                        <div class="ribbon-content">
                            <div class="form-group mb-2">
                                <label for="publish">Publish</label>
                                <select name="publish" class="form-control">
                                    @foreach ($publises as $publish)
                                    <option value="{{ $publish }}">{{ $publish }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-blue"><i class="mdi mdi-publish"></i>
                                    Publish</button>
                            </div>
                        </div>
                    </div> <!-- end card-box -->
                </div>

            </div> <!-- container -->

        </form>

    </div> <!-- content -->
</div> <!-- content -->
@endsection
@include('backend.post.includes.js.action-js')