@extends('layouts.frontend.frontend')
@section('title','Berita')

@push('seo-costume')
<meta name="title" content="{{ SiteHelper::seo_setting()->seo_title }}">
<meta name="description" content="{{ SiteHelper::seo_setting()->seo_meta_description }}">
<meta name="keywords" content="{{ SiteHelper::seo_setting()->seo_keywords }}">
<meta name="author" content="{{ SiteHelper::seo_setting()->author_name }}">
<meta property="og:title" content="{{ SiteHelper::seo_setting()->seo_title }}" />
<meta property="og:author" content="{{ SiteHelper::seo_setting()->author }}" />
<meta property="og:description" content="{{ SiteHelper::seo_setting()->about_site }}" />
@endpush

@section('content-front')
<section class="wrapper image-wrapper bg-image bg-cover bg-overlay text-white"
    data-image-src="{{ asset('assets/frontend') }}/img/banner-2.png">
    <div class="container pt-18 pb-15 pt-md-20 pb-md-19 text-center">
        <div class="row">
            <div class="col-md-10 col-xl-8 mx-auto">
                <div class="post-header">
                    <div class="post-category text-line text-white">
                        <a href="/" class="text-reset" rel="category">Beranda</a>
                    </div>
                    <!-- /.post-category -->
                    <h1 class="display-1 mb-4 text-white">@yield('title')</h1>
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

<section class="wrapper bg-light">
    <div class="container py-5 py-md-5">
        <div class="row gx-lg-8 gx-xl-12">
            <div class="col-lg-8">
                <div class="blog classic-view">
                    @forelse ($posts as $post)
                    <article class="post">
                        <div class="card">
                            <figure class="card-img-top overlay overlay-1 hover-scale">
                                <a href="{{ route('home.news.detail',$post->slug) }}" class="views-add"
                                    data-idpost="{{ $post->id }}">
                                    <img src="{{ asset('storage/img').'/'.$post->image }}" loading="lazy"
                                        alt="{{ $post->title }}" />
                                </a>
                                <figcaption>
                                    <h5 class="from-top mb-0">Baca Selengkapnya</h5>
                                </figcaption>
                            </figure>
                            <div class="card-body p-4">
                                <div class="post-header">
                                    <div class="post-category text-line">
                                        <a href="/home/news?category={{ $post->category->slug }}" class="hover"
                                            rel="category">{{ $post->category->title }}</a>
                                    </div>
                                    <!-- /.post-category -->
                                    <h2 class="post-title mt-1 mb-0">
                                        <a class="link-dark views-add"
                                            href="{{ route('home.news.detail',$post->slug) }}"
                                            data-idpost="{{ $post->id }}">
                                            {{ $post->title }}
                                        </a>
                                    </h2>
                                </div>
                                <!-- /.post-header -->
                                <div class="post-content">
                                    {!! Str::limit($post->content, 350) !!}
                                </div>
                                <!-- /.post-content -->
                            </div>
                            <!--/.card-body -->
                            <div class="card-footer p-4">
                                <ul class="post-meta d-flex mb-0">
                                    <li class="post-date"><i class="uil uil-calendar-alt"></i>
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
                                        <a href="/home/news?user={{ $post->user->name }}"><i class="uil uil-user"></i>
                                            <span>By
                                                {{ $post->user->name }}
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
                    @empty
                    <div class="alert alert-warning alert-icon" role="alert">
                        <i class="uil uil-exclamation-triangle"></i> Post not found!.
                    </div>
                    @endforelse
                    <!-- /.post -->
                </div>
                <!-- /.blog -->
                {{ $posts->onEachSide(0)->links() }}
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