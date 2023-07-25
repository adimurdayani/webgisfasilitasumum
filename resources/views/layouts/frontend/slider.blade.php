<section class="wrapper bg-dark">
    <div class="swiper-container swiper-hero dots-over" data-margin="0" data-autoplay="true" data-autoplaytime="7000"
        data-nav="true" data-dots="true" data-items="1">
        <div class="swiper">
            <div class="swiper-wrapper">
                @foreach ($carousels as $carousel)
                <div class="swiper-slide bg-overlay bg-overlay-400 bg-dark bg-image"
                    data-image-src="{{ asset('storage/img/'.$carousel->image) }}">
                    <div class="container h-100">
                        <div class="row h-100">
                            <div
                                class="{{ $carousel->style == null ? 'col-md-11 col-lg-8 col-xl-7 col-xxl-6 mx-auto '.$carousel->style : 'col-md-10 offset-md-1 col-lg-7 offset-lg-0 col-xl-6 col-xxl-5 '.$carousel->style }} text-center justify-content-center align-self-center">
                                <h2
                                    class="display-1 fs-56 mb-4 text-white animate__animated animate__slideInDown animate__delay-1s">
                                    {{ Str::limit($carousel->title,25,'...') }}</h2>
                                <p
                                    class="lead fs-23 lh-sm mb-7 text-white animate__animated animate__slideInRight animate__delay-2s">
                                    {{ Str::limit($carousel->description,150,'...') }}
                                </p>
                            </div>
                            <!--/column -->
                        </div>
                        <!--/.row -->
                    </div>
                    <!--/.container -->
                </div>
                <!--/.swiper-slide -->
                @endforeach
            </div>
            <!--/.swiper-wrapper -->
        </div>
        <!-- /.swiper -->
    </div>
    <!-- /.swiper-container -->
</section>