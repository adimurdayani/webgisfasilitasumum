<section id="news">
    <div class="wrapper bg-gray">

        <div class="container py-5 py-md-5">

            <div class="row">
                <div class="col-lg-9 col-xl-8 col-xxl-7 mx-auto">
                    <h2 class="fs-15 text-uppercase text-primary text-center">Our News</h2>
                    <h3 class="display-4 mb-6 text-center">Here are the latest company news from our blog that got the
                        most
                        attention.</h3>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
            <div class="position-relative">
                <div class="shape bg-dot primary rellax w-17 h-20" data-rellax-speed="1" style="top: 0; left: -1.7rem;">
                </div>
                <div class="swiper-container dots-closer blog grid-view mb-6" data-margin="0" data-dots="true"
                    data-items-xl="3" data-items-md="2" data-items-xs="1">
                    <div class="swiper">
                        <div class="swiper-wrapper">

                            @forelse ($posts as $post)
                            <div class="swiper-slide">
                                <div class="item-inner">
                                    <article>
                                        <div class="card">
                                            <figure class="card-img-top overlay overlay-1 hover-scale">
                                                <a href="{{ route('home.news.detail',$post->slug) }}" class="views-add"
                                                    data-idpost="{{ $post->id }}">
                                                    <img src="{{ $post->image == null ? asset('assets/images/not_found.jpg') : asset('storage/public/img/'. $post->image) }}"
                                                        alt="{{ $post->title }}" title="{{ $post->title }}" />
                                                </a>
                                                <figcaption>
                                                    <h5 class="from-top mb-0">Read More</h5>
                                                </figcaption>
                                            </figure>
                                            <div class="card-body">
                                                <div class="post-header">
                                                    <div class="post-category text-line">
                                                        <a href="/home/news?category={{ $post->category->slug }}"
                                                            class="hover" rel="category">
                                                            {{ $post->category->title }}
                                                        </a>
                                                    </div>
                                                    <!-- /.post-category -->
                                                    <h2 class="post-title h3 mt-1 mb-3">
                                                        <a class="link-dark views-add"
                                                            href="{{ route('home.news.detail',$post->slug) }}"
                                                            data-idpost="{{ $post->id }}">
                                                            {{ Str::limit($post->title,50) }}
                                                        </a>
                                                    </h2>
                                                </div>
                                                <!-- /.post-header -->
                                                <div class="post-content">
                                                    {!! Str::limit($post->content,150) !!}
                                                </div>
                                                <!-- /.post-content -->
                                            </div>
                                            <!--/.card-body -->
                                            <div class="card-footer">
                                                <ul class="post-meta d-flex mb-0">
                                                    <li class="post-date">
                                                        <i class="uil uil-calendar-alt"></i>
                                                        <span>
                                                            {{
                                                            \Carbon\Carbon::parse($post->created_at)->locale('id')->diffForHumans()
                                                            }}
                                                        </span>
                                                    </li>
                                                    <li class="post-comments">
                                                        <a href="#"><i class="uil uil-eye"></i>{{ $post->views == null ?
                                                            '0' : number_format($post->views, 0) }}</a>
                                                    </li>
                                                </ul>
                                                <!-- /.post-meta -->
                                            </div>
                                            <!-- /.card-footer -->
                                        </div>
                                        <!-- /.card -->
                                    </article>
                                    <!-- /article -->
                                </div>
                                <!-- /.item-inner -->
                            </div>
                            <!--/.swiper-slide -->
                            @empty
                            <div class="alert alert-warning alert-icon" role="alert">
                                <i class="uil uil-exclamation-triangle"></i> News not found!.
                            </div>
                            @endforelse

                        </div>
                        <!--/.swiper-wrapper -->
                    </div>
                    <!-- /.swiper -->
                </div>
                <!-- /.swiper-container -->
            </div>
            <!-- /.position-relative -->
        </div>
        <!-- /.container -->
    </div>
</section>
<!-- /section -->