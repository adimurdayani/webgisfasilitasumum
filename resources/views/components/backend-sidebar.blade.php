<div id="sidebar-menu">
    <ul id="side-menu">

        @foreach(SiteHelper::menu() as $m)

        @if (SiteHelper::access_menu($m->id, Auth::user()->role_id))
        <li class="menu-title">{{ $m->name }}</li>
        @endif

        @foreach (SiteHelper::submenu($m->id) as $sm)

        @if (SiteHelper::access_submenu($sm->id, Auth::user()->role_id))
        <li>
            @if ($sm->collapse)


            <a href="#{{ $sm->url }}" data-toggle="{{ $sm->collapse }}">
                <i class="{{ $sm->icon }}"></i>
                <span> {{ $sm->title }} </span>
                <span {{ $sm->collapse != null ? 'class=menu-arrow':'' }}></span>
            </a>
            <div class="collapse" id="{{ $sm->url }}">
                <ul class="nav-second-level">
                    @foreach ($sm->menuItems as $mi)

                    @if (SiteHelper::access_menuitem($mi->id, Auth::user()->role_id))
                    <li>
                        <a href="{{ $mi->url }}">{{ $mi->title }}</a>
                    </li>

                    @endif

                    @endforeach
                </ul>
            </div>

            @else
            <a href="{{ $sm->url }}">
                <i class="{{ $sm->icon }}"></i>
                <span> {{ $sm->title }} </span>
            </a>
            @endif

            @endif
        </li>

        @endforeach

        @endforeach
    </ul>
</div>