<footer class="bg-dark text-inverse">
    <div class="container py-13 py-md-15">
        <div class="row gy-6 gy-lg-0">
            <div class="col-md-4 col-lg-3" @if (!isset(widget('footer')->is_active))
                hidden="hidden"
                @endif>
                <div class="widget">
                    <h4 class="widget-title text-white mb-3">{{ widget('footer') == null ? '' :
                        widget('footer')->title}}</h4>
                    <ul class="image-list">
                        @foreach (SiteHelper::populer_post() as $item_populer)
                        <li>
                            <figure class="rounded">
                                <a href="{{ route('home.news.detail',$item_populer->slug) }}" class="views-add"
                                    data-idpost="{{ $item_populer->id }}">
                                    <img src="{{ asset('storage/public/img/'.$item_populer->image) }}"
                                        alt="{{ $item_populer->title }}" title="{{ $item_populer->title }}"
                                        loading="lazy">
                                </a>
                            </figure>
                            <div class="post-content">
                                <h6 class="mb-2">
                                    <a class="link-dark views-add"
                                        href="{{ route('home.news.detail',$item_populer->slug) }}"
                                        data-idpost="{{ $item_populer->id }}">
                                        {{ Str::limit($item_populer->title,15,'...') }}
                                    </a>
                                </h6>
                                <ul class="post-meta">
                                    <li class="post-date"><i class="uil uil-calendar-alt"></i>
                                        <span>{{
                                            \Carbon\Carbon::parse($item_populer->created_at)->locale('id')->settings(['formatFunction'
                                            =>
                                            'translatedFormat'])->format('l, j F Y'); }}
                                        </span>
                                    </li>
                                </ul>
                                <!-- /.post-meta -->
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <!-- /.image-list -->
                </div>
            </div>
            <!-- /column -->
            <div class="col-md-4 col-lg-3">
                <!-- /.widget -->
                <div class="widget">
                    <h4 class="widget-title text-white mb-3">Category</h4>
                    <ul class="unordered-list text-reset bullet-white ">
                        @foreach (SiteHelper::categories() as $category)
                        <li><a href="/home/news?category={{ $category->slug }}">{{ $category->title }} ({{
                                $category->posts->count() }})</a></li>
                        @endforeach
                    </ul>
                </div>
                <!-- /.widget -->
                <div class="widget">
                    <h4 class="widget-title text-white mb-3">Visitor Statistic</h4>
                    <ul class="list-unstyled text-reset mb-0">
                        <li>Kunjungan ({{ number_format(visits(),0) }})</li>
                        <li>Kemarin ({{ number_format(visit_yesterday(),0) }})</li>
                        <li>Bulan Ini ({{ number_format(visitor_month(),0) }})</li>
                        <li>Total ({{ number_format(total_visitor(),0) }})</li>
                    </ul>
                </div>
                <!-- /.widget -->
            </div>
            <!-- /column -->
            <div class="col-md-4 col-lg-3">
                <div class="widget">
                    <h4 class="widget-title text-white mb-3">Contact</h4>
                    <address class="pe-xl-15 pe-xxl-17">{{ setting(1)->address }}
                    </address>
                    <a href="mailto:{{ setting(1)->email }}">{{ setting(1)->email }}</a><br />
                    Telp. {{ setting(1)->phone }} <br> Fax. {{ setting('1')->tax_number }}
                </div>
                <!-- /.widget -->
                <div class="widget">
                    <h4 class="widget-title text-white mb-3">Social</h4>
                    <nav class="nav social social-white">
                        <a href="{{ setting(1)->link_twitter }}"><i class="uil uil-twitter"></i></a>
                        <a href="{{ setting(1)->link_facebook }}"><i class="uil uil-facebook-f"></i></a>
                        <a href="{{ setting(1)->link_whatsapp }}"><i class="uil uil-whatsapp"></i></a>
                        <a href="{{ setting(1)->link_instagram }}"><i class="uil uil-instagram"></i></a>
                        <a href="{{ setting(1)->link_youtube }}"><i class="uil uil-youtube"></i></a>
                        <a href="{{ route('home.feeds.news') }}" target="_blank"><i class="uil uil-rss"></i></a>
                    </nav>
                    <!-- /.social -->
                </div>
                <!-- /.widget -->
            </div>
            <!-- /column -->
            <div class="col-md-4 col-lg-3">
                <div class="widget">
                    <h4 class="widget-title text-white mb-3">Learn More</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home.privacys.index') }}">Privacy Policy</a></li>
                    </ul>
                </div>
                <!-- /.widget -->
            </div>
            <!-- /column -->
        </div>
        <!--/.row -->
        <p class="mt-6 mb-0 text-center">© {{ date('Y'). ' '. setting(1)->copyright_text }}
        </p>
    </div>
    <!-- /.container -->
</footer>