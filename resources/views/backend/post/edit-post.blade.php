@extends('layouts.backend.admin')
@section('title',Str::limit($post->title,50))

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

        <form action="{{ route('app.posts.update',$post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-8">
                    <div class="card-box ribbon-box">
                        <div class="ribbon ribbon-warning float-left mb-4"><i class="mdi mdi-text-box mr-1"></i> {{
                            __('Content Post') }}
                        </div>

                        <div class="float-right mb-4 mt-0">
                            <a href="{{ route('app.posts.index') }}" class="text-secondary"><i
                                    class="mdi mdi-view-list"></i>
                                {{ __('List Post') }}</a>
                        </div>
                        <div class="ribbon-content">

                            <div class="form-group mb-3">
                                <label for="title">{{ __("Title") }} <span class="text-danger">*</span></label>
                                <input type="text" name="title"
                                    class="form-control @error('title') is-invalid @enderror" placeholder="Enter title"
                                    value="{{ $post->title }}" autofocus>

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="sub_title">{{ __("Sub Title") }}</label>
                                <input type="text" name="sub_title" class="form-control" placeholder="Enter sub title"
                                    value="{{ $post->sub_title }}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="content">{{ __("Content") }} <span class="text-danger">*</span></label>
                                <textarea name="content" id="content" cols="30" rows="20"
                                    class="form-control @error('content') is-invalid @enderror ckeditor">{!! $post->content !!}</textarea>

                                @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                    </div> <!-- end card-box -->

                    <div class="card-box ribbon-box">
                        <div class="ribbon ribbon-warning float-left mb-4"><i class="mdi mdi-view-list mr-1"></i>
                            {{ __("Visibility") }}
                        </div>
                        <div class="ribbon-content">
                            <h4 class="header-title mt-5 mt-sm-0">{{ __("Status") }}</h4>
                            <div class="mt-3 form-inline mb-4">
                                <div class="custom-control custom-radio mr-4">
                                    <input type="radio" id="customRadio1" name="is_active" value="1" {{ $post->is_active
                                    == true ? 'checked' : '' }}
                                    class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">{{ __("Show") }}</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="is_active" value="0" {{ $post->is_active
                                    == false ? 'checked' : '' }}
                                    class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">{{ __("Hide") }}</label>
                                </div>
                            </div>

                            <h4 class="header-title mt-5 mt-sm-0">{{__('Visibility')}}</h4>
                            <div class="mt-3">
                                @foreach ($visibility as $v)
                                <div class="custom-control custom-checkbox mb-2">
                                    <input type="checkbox" class="custom-control-input" name="visibilitie_id[]"
                                        value="{{ $v->id }}" @foreach ($post->visibilities as $pv)
                                    {{ $pv->id == $v->id ? 'checked' : '' }}
                                    @endforeach
                                    id="visibility-{{ $v->id }}">
                                    <label class="custom-control-label" for="visibility-{{ $v->id }}">
                                        {{ $v->title }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div> <!-- end card-box -->

                    <div class="card-box ribbon-box">
                        <div class="ribbon ribbon-warning float-left mb-4"><i class="mdi mdi-text-box-outline mr-1"></i>
                            {{__('SEO Details')}}
                        </div>
                        <div class="ribbon-content">
                            <div class="form-group mb-2">
                                <label for="meta_title">{{__('Title')}} <span class="text-muted">(Meta
                                        Title)</span></label>
                                <input type="text" name="meta_title" id="meta_title" value="{{ $post->meta_title }}"
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
                                        <label for="meta_keywords">{{__('Keywords')}} <span class="text-muted">({{
                                                __('Meta
                                                Keywords') }})</span></label>
                                        <input type="text" name="meta_keywords" id="meta_keywords"
                                            value="{{ $post->meta_keywords }}"
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
                                        <label for="meta_tag">{{__('Tags')}} <span class="text-muted">({{ __('Meta
                                                tag') }})</span></label>
                                        <input type="text" name="meta_tag" id="selectize-tags"
                                            class="form-control @error('meta_tag') is-invalid @enderror"
                                            value="{{ $post->meta_tag }}" placeholder="Enter meta tags">

                                        @error('meta_tag')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="meta_description">{{__('Description')}} <span class="text-muted">({{
                                        __('Meta
                                        Description') }})</span></label>
                                <textarea name="meta_description" rows="5" cols="30"
                                    class="form-control @error('meta_description') is-invalid @enderror"
                                    placeholder="Enter meta description">{!! $post->meta_description !!}</textarea>

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
                        <div class="ribbon ribbon-warning float-left mb-4"><i class="mdi mdi-image-album mr-1"></i>
                            {{__('Image')}}
                        </div>
                        <div class="ribbon-content">
                            <div class="text-center">
                                <img src="{{ asset('storage/public/img/'.$post->image) }}" class="img-thumbnail mb-2"
                                    width="50%" alt="Image Post" loading="lazy">
                            </div>

                            <div class="form-group mt-3 mb-2">
                                <label for="projectname" class="mb-0">{{__('Images')}} <span
                                        class="text-danger">*</span></label>
                                <p class="text-muted font-14">{{__('Recommended images size')}} 960x600 (px).</p>
                                <input type="file" name="image" id="image">
                            </div>

                            <div class="form-group">
                                <label for="image_description">{{__('Image Description')}} <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="image_description"
                                    class="form-control @error('image_description') is-invalid @enderror"
                                    value="{{ $post->image_description }}" placeholder="Enter image description">

                                @error('image_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div> <!-- end card-box -->
                    <div class="card-box ribbon-box">
                        <div class="ribbon ribbon-warning float-left mb-4"><i class="mdi mdi-view-list mr-1"></i>
                            {{ __('Category') }}
                        </div>
                        <div class="ribbon-content">
                            <div class="form-group mb-2">
                                <label for="categorie_id">{{ __('Category') }}</label>
                                <select name="categorie_id" id="categorie_id" class="form-control"
                                    data-toggle="select2">
                                    <option value="">-- {{ __('Select') }} --</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $post->categorie_id == $category->id ?
                                        'selected' : '' }}>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-2">
                                <label for="id_subcategories">{{ __('Sub Category') }}</label>
                                <select name="id_subcategories" class="form-control" data-toggle="select2">
                                    <option value="{{ $post->subcategorie_id }}">@isset($post->subcategorie_id)
                                        {{ $post->subCategory->title }}
                                        @endisset
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div> <!-- end card-box -->

                    <div class="card-box ribbon-box">
                        <div class="ribbon ribbon-warning float-left mb-4"><i class="mdi mdi-publish mr-1"></i> {{
                            __('Publish') }}
                        </div>
                        <div class="ribbon-content">
                            <div class="form-group mb-2">
                                <label for="publish">{{ __('Publish') }}</label>
                                <select name="publish" class="form-control">
                                    <option value="publish" {{ $post->publish == 'publish' ? 'selected' : '' }}>{{
                                        __('Publish') }}
                                    </option>
                                    <option value="draf" {{ $post->publish == 'draf' ? 'selected' : '' }}>{{ __('Draf')
                                        }}
                                    </option>
                                </select>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-warning"><i class="mdi mdi-publish"></i>
                                    {{ __('Publish') }}</button>
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