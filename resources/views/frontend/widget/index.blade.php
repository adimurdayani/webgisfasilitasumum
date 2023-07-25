<aside class="col-lg-4 sidebar mt-8 mt-lg-6">
    <div class="widget">
        <form class="search-form" id="cari-berita" action="{{ route('home.news.index') }}">
            @csrf
            @if (request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
            @endif

            <div class="form-floating mb-0">
                <input id="search-form" type="text" value="{{ request('search') }}" name="search" class="form-control"
                    placeholder="Search">
                <label for="search-form">Cari</label>
            </div>
        </form>
        <!-- /.search-form -->
    </div>
    <!-- /.widget -->
    <div class="widget" @if (!isset(berita_baru('feature post')->is_active))
        hidden="hidden"
        @endif>
        <h4 class="widget-title mb-3">{{ berita_baru('feature post') == null ? '' : berita_baru('feature post')->title
            }}</h4>
        <ul class="image-list">
            @foreach (SiteHelper::getBeritaBaru() as $beritaBaru)
            <li>
                <figure class="rounded">
                    <a href="{{ route('home.news.detail',$beritaBaru->slug) }}" data-idpost="{{ $beritaBaru->id }}"
                        class="views-add">
                        <img src="{{ asset('storage/img/'.$beritaBaru->image) }}" alt="{{ $beritaBaru->title }}"
                            loading="lazy" />
                    </a>
                </figure>
                <div class="post-content">
                    <h6 class="mb-2">
                        <a class="link-dark views-add" href="{{ route('home.news.detail',$beritaBaru->slug) }}"
                            data-idpost="{{ $beritaBaru->id }}">
                            {{ Str::limit($beritaBaru->title,20,'...') }}
                        </a>
                    </h6>
                    <ul class="post-meta">
                        <li class="post-date">
                            <i class="uil uil-calendar-alt"></i>
                            <span>
                                {{
                                \Carbon\Carbon::parse($beritaBaru->created_at)->locale('id')->diffForHumans();
                                }}
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
    <div class="widget" @if (!isset(widget('right sidebar')->is_active))
        hidden="hidden"
        @endif>
        <h4 class="widget-title mb-3">{{ widget('right sidebar') == null ? '' : widget('right sidebar')->title }}</h4>
        <ul class="image-list">
            @foreach (SiteHelper::populer_post() as $post)
            <li>
                <figure class="rounded">
                    <a href="{{ route('home.news.detail',$post->slug) }}" class="views-add"
                        data-idpost="{{ $post->id }}">
                        <img src="{{ asset('storage/img/'.$post->image) }}" alt="{{ $post->title }}" />
                    </a>
                </figure>
                <div class="post-content">
                    <h6 class="mb-2"> <a class="link-dark" href="{{ route('home.news.detail',$post->slug) }}"
                            data-idpost="{{ $post->id }}">{{ Str::limit($post->title,20,'...') }}
                        </a>
                    </h6>
                    <ul class="post-meta">
                        <li class="post-date"><i class="uil uil-calendar-alt"></i>
                            <span>
                                {{
                                \Carbon\Carbon::parse($post->created_at)->locale('id')->settings(['formatFunction'
                                =>
                                'translatedFormat'])->format('j F Y');
                                }}

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
    <!-- /.widget -->
    <div class="widget">
        <h4 class="widget-title mb-3">Kategori</h4>
        <ul class="unordered-list bullet-primary text-reset">
            @foreach (SiteHelper::categories() as $category)
            <li><a href="/home/news?category={{ $category->slug }}">
                    {{ $category->title }} ({{ $category->posts->count() }})
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    <!-- /.widget -->
</aside>
<!-- /column .sidebar -->