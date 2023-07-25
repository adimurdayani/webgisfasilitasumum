<section id="about">
    <div class="wrapper bg-gray">
        <div class="container py-10 py-md-15">
            <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center">
                <div class="col-md-8 col-lg-6 col-xl-6 order-lg-2 position-relative">
                    <div class="shape bg-soft-primary rounded-circle rellax w-20 h-20" data-rellax-speed="1"
                        style="top: -2rem; right: -1.9rem;"></div>
                    <figure class="rounded">
                        <img src="{{ setting(1)->img_user != null ? asset('storage/img').'/'.setting(1)->img_user : asset('assets/images/not_found.jpg') }}"
                            srcset="{{ setting(1)->img_user != null ? asset('storage/img').'/'.setting(1)->img_user : asset('assets/images/not_found.jpg') }} 2x"
                            alt="{{ setting(1)->seo_title }}" title="{{ setting(1)->seo_title }}">
                    </figure>
                </div>
                <!--/column -->
                <div class="col-lg-6">
                    <h2 class="display-4 mb-3">{{ SiteHelper::seo_setting()->app_name }}</h2>
                    <p class="lead fs-lg">{{ SiteHelper::seo_setting()->about_site }}</p>
                </div>
                <!--/.row -->
            </div>
            <!--/column -->
        </div>
        <!--/.row -->
    </div>
    <!-- /.container -->
    </div>
</section>
<!-- /section -->