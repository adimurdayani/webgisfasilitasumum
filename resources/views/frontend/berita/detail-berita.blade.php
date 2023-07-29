@extends('layouts.frontend.frontend')
@section('title','Detail Berita')

@push('seo-costume')
<meta name="title" content="{{ $post->title }}">
<meta name="description" content="{{ $post->meta_description }}">
<meta name="keywords" content="{{ $post->meta_keywords }}">
<meta name="author" content="{{ SiteHelper::seo_setting()->author_name }}">
<meta property="og:title" content="{{ $post->title }}" />
<meta property="og:author" content="{{ SiteHelper::seo_setting()->author }}" />
<meta property="og:description" content="{{ $post->meta_description }}" />
@endpush

@section('content-front')
<section class="wrapper image-wrapper bg-image bg-overlay text-white"
    data-image-src="{{ asset('storage/public/img').'/'.$post->image }}">
    <div class="container pt-18 pb-15 pt-md-20 pb-md-19 text-center">
        <div class="row">
            <div class="col-md-10 col-xl-8 mx-auto">
                <div class="post-header">
                    <div class="post-category text-line text-white">
                        <a href="/home/news?category={{ $post->category->slug }}" class="text-reset" rel="category">
                            {{ $post->category->title }}
                        </a>
                    </div>
                    <!-- /.post-category -->
                    <h1 class="display-1 mb-4 text-white">Berita</h1>
                    <ul class="post-meta text-white">
                        <li class="post-date">
                            <i class="uil uil-calendar-alt"></i>
                            <span>
                                {{
                                \Carbon\Carbon::parse($post->created_at)
                                ->locale('id')
                                ->settings(['formatFunction' => 'translatedFormat'])
                                ->format('l, j F Y'); }}
                            </span>
                        </li>
                        <li class="post-author">
                            <i class="uil uil-user"></i>
                            <a href="/home/news?user={{ $post->user->name }}" class="text-reset">
                                <span>By {{ $post->user->name }}</span>
                            </a>
                        </li>
                        <li class="post-comments">
                            <i class="uil uil-eye"></i>
                            <a href="#" class="text-reset">
                                {{ $post->views == null ? '0' : number_format($post->views,0) }}
                                <span> Views</span>
                            </a>
                        </li>
                    </ul>
                    <!-- /.post-meta -->
                </div>
                <!-- /.post-header -->
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->

<section class="wrapper">
    <div class="container py-5 py-md-10">
        <div class="row gx-lg-8 gx-xl-12">
            <div class="col-lg-8">
                <div class="blog classic-view">
                    <article class="post">
                        <div class="card">
                            <figure class="card-img-top hover-scale" {{ $post->type == 'article' ?
                                '':'hidden=hidden' }}>
                                <a href="{{ route('home.news.detail',$post->slug) }}" data-idpost="{{ $post->id }}"
                                    class="views-add">
                                    <img src="{{ asset('storage/public/img').'/'.$post->image }}"
                                        alt="{{ $post->title }}" title="{{ $post->title }}" loading="lazy" />
                                </a>

                                <div class="text-center"><small><i>{{ $post->title }}</i></small></div>
                            </figure>
                            <div class="card-img-top" {{ $post->type == 'video' ? '':'hidden=hidden' }}>
                                <div class="player" data-plyr-provider="{{ $post->type == 'video' ? 'youtube':'' }}"
                                    data-plyr-embed-id="{{ $post->url_video == null ? '': $post->url_video }}"></div>
                            </div>
                            <div class="card-body p-4">
                                <div class="post-header">
                                    <div class="post-category text-line">
                                        <a href="/home/news?category={{ $post->category->slug }}" class="hover"
                                            rel="category">{{ $post->category->title }}</a>
                                    </div>
                                    <!-- /.post-category -->
                                    <h2 class="post-title mt-1 mb-0">
                                        <a class="link-dark views-add">
                                            {{ $post->title }} {{ $post->sub_title }}
                                        </a>
                                    </h2>
                                </div>
                                <!-- /.post-header -->
                                <div class="post-content">
                                    {!! $post->content !!}
                                </div>
                                <!-- /.post-content -->
                            </div>
                            <!--/.card-body -->
                            <div class="card-footer p-2">
                                <ul class="post-meta d-flex mb-0">
                                    <li class="post-date">
                                        <i class="uil uil-calendar-alt"></i>
                                        <span>
                                            {{
                                            \Carbon\Carbon::parse($post->created_at)
                                            ->locale('id')
                                            ->settings(['formatFunction' => 'translatedFormat'])
                                            ->format('l, j F Y');
                                            }}
                                        </span>
                                    </li>
                                    <li class="post-author">
                                        <a href="/home/news?user={{ $post->user->name }}">
                                            <i class="uil uil-user"></i>
                                            <span>
                                                By {{ $post->user->name }}
                                            </span>
                                        </a>
                                    </li>
                                    <li class="post-comments">
                                        <a href="#">
                                            <i class="uil uil-eye"></i>
                                            {{ $post->views == null ? '0' : number_format($post->views, 0) }}
                                            <span> Views </span>
                                        </a>
                                    </li>
                                </ul>
                                <!-- /.post-meta -->
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </article>
                    <!-- /.post -->
                </div>
                <!-- /.blog -->
                <div class="blog grid grid-view">
                    <div class="row isotope gx-md-8 gy-8 mb-8">
                        @forelse (postCategory($post->categorie_id) as $category)
                        <article class="item post col-md-6">
                            <div class="card">
                                <figure class="card-img-top overlay overlay-1 hover-scale">
                                    <a href="{{ route('home.news.detail',$category->slug) }}" class="views-add"
                                        data-idpost="{{ $category->id }}">
                                        <img src="{{ asset('storage/public/img').'/'.$category->image }}"
                                            alt="{{ $category->title }}" loading="lazy" />
                                    </a>
                                    <figcaption>
                                        <h5 class="from-top mb-0">Baca Selengkapnya</h5>
                                    </figcaption>
                                </figure>
                                <div class="card-body p-4">
                                    <div class="post-header">
                                        <div class="post-category text-line">
                                            <a href="/home/news?category={{ $category->category->slug }}" class="hover"
                                                rel="category">
                                                {{ $category->category->title }}
                                            </a>
                                        </div>
                                        <!-- /.post-category -->
                                        <h2 class="post-title h3 mt-1 mb-3">
                                            <a class="link-dark views-add"
                                                href="{{ route('home.news.detail',$category->slug) }}"
                                                data-idpost="{{ $category->id }}">
                                                {{ Str::limit($category->title,50) }}
                                            </a>
                                        </h2>
                                    </div>
                                    <!-- /.post-header -->
                                    <div class="post-content">
                                        {!! Str::limit($category->content,250) !!}
                                    </div>
                                    <!-- /.post-content -->
                                </div>
                                <!--/.card-body -->
                                <div class="card-footer p-2">
                                    <ul class="post-meta d-flex mb-0">
                                        <li class="post-date">
                                            <i class="uil uil-calendar-alt"></i>
                                            <span>
                                                {{
                                                \Carbon\Carbon::parse($category->created_at)
                                                ->locale('id')
                                                ->settings(['formatFunction' => 'translatedFormat'])
                                                ->format('l, j F Y');
                                                }}
                                            </span>
                                        </li>
                                        <li class="post-comments">
                                            <a href="#">
                                                <i class="uil uil-eye"></i>
                                                {{
                                                $category->views == null ? '0' : number_format($category->views, 0)
                                                }}
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- /.post-meta -->
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->
                        </article>
                        <!-- /.post -->
                        @empty

                        @endforelse
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.blog -->
            </div>
            <!-- /column -->
            @include('frontend.widget.index')
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->
@endsection

@include('frontend.berita.includes.index-js')