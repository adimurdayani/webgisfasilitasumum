@extends('layouts.backend.admin')
@section('title','Sitemap Role')

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
                            <li class="breadcrumb-item"><a href="{{ route('app.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('app.roles.index') }}">Roles</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@yield('title')</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box ribbon-box">
                    <div class="ribbon ribbon-warning float-left"><i class="mdi mdi-plus mr-1"></i>
                        Manage Permission Pages for Role
                    </div>
                    <div class="float-right mt-0">
                        <a href="{{ route('app.roles.index') }}" class="text-secondary"><i class="fe-list"></i>
                            List Role</a>
                    </div>
                    <div class="ribbon-content">

                        <h4 class="header-title text-center">Sitemaps Pages</h4>
                        <hr>
                        <div data-spy="scroll" data-target="#navbar-example3" data-offset="0" class="scrollspy-example"
                            style="height: 350px;">
                            @forelse ($modules->chunk(3) as $key => $chunk)

                            <div class="form-row">
                                @foreach ($chunk as $key => $module)
                                <div class="col">
                                    <ul class="sitemap">
                                        <li><a href="javascript: void(0);" class="text-uppercase font-weight-bold"><i
                                                    class="mdi mdi-adjust mr-1"></i>{{ $module->name }}</a>
                                            <ul>
                                                @foreach ($module->permissions as $permission)
                                                <li><a href="javascript: void(0);"><i class="fe-airplay mr-1"></i>{{
                                                        $permission->name }}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                @endforeach
                            </div>

                            @empty
                            <div class="row">
                                <div class="col text-center">
                                    <strong>No module found!</strong>
                                </div>
                            </div>
                            @endforelse
                        </div>


                    </div>

                </div>

                <div class="card-box ribbon-box">
                    <div class="ribbon ribbon-warning float-left"><i class="mdi mdi-plus mr-1"></i>
                        Manage Permission Menus for Role
                    </div>
                    <div class="ribbon-content">

                        <h4 class="header-title text-center">Sitemaps Menus</h4>
                        <hr>

                        <div data-spy="scroll" data-target="#navbar-example3" data-offset="0" class="scrollspy-example"
                            style="height: 350px;">

                            @forelse ($menus->chunk(3) as $key => $chunk)

                            <div class="form-row">
                                @foreach ($chunk as $key => $menu)
                                <div class="col">
                                    <ul class="sitemap">
                                        <li><a href="javascript: void(0);" class="text-uppercase font-weight-bold"><i
                                                    class="mdi mdi-adjust mr-1"></i>{{ $menu->name }}</a>
                                            <ul>
                                                @foreach ($menu->subMenus as $sm)
                                                <li><a href="javascript: void(0);"><i class="fe-airplay mr-1"></i>{{
                                                        $sm->title }}</a>
                                                </li>
                                                <ul>
                                                    @foreach ($sm->menuItems as $mi)
                                                    <li><a href="javascript: void(0);"><i class="fe-airplay mr-1"></i>{{
                                                            $mi->title }}</a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                @endforeach
                            </div>

                            @empty
                            <div class="row">
                                <div class="col text-center">
                                    <strong>No module found!</strong>
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div> <!-- content -->
</div> <!-- content -->

@endsection