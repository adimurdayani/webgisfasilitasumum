<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon"
        href="{{ setting(1)->img_fav != null ? asset('storage/public/img').'/'.setting(1)->img_fav : asset('assets/images/not_found.jpg') }}">

    <link href="{{ asset('assets') }}/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('assets') }}/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets') }}/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

    @stack('page-css')

    <!-- Sweet Alert-->
    <link href="{{ asset('assets') }}/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('assets') }}/css/bootstrap-material.min.css" rel="stylesheet" type="text/css"
        id="bs-default-stylesheet" />
    <link href="{{ asset('assets') }}/css/app-material.min.css" rel="stylesheet" type="text/css"
        id="app-default-stylesheet" />

    <link href="{{ asset('assets') }}/css/bootstrap-material-dark.min.css" rel="stylesheet" type="text/css"
        id="bs-dark-stylesheet" {{ SiteHelper::themes()->mode == 'dark' ? '' : 'disabled' }} />
    <link href="{{ asset('assets') }}/css/app-material-dark.min.css" rel="stylesheet" type="text/css"
        id="app-dark-stylesheet" {{ SiteHelper::themes()->mode == 'dark' ? '' : 'disabled' }} />

    <!-- icons -->
    <link href="{{ asset('assets') }}/css/icons.min.css" rel="stylesheet" type="text/css" />

</head>

<body
    data-layout='{"mode": "{{ SiteHelper::themes()->mode }}", "width": "{{ SiteHelper::themes()->width }}", "menuPosition": "{{ SiteHelper::themes()->menu_position }}", "sidebar": { "color": "{{ SiteHelper::themes()->sidebar_color }}", "size": "{{ SiteHelper::themes()->sidebar_size }}", "showuser": {{ SiteHelper::themes()->sidebar_showuser }} }, "topbar": {"color": "{{ SiteHelper::themes()->topbar_color }}"}}'
    data-sidebar-size="{{ SiteHelper::themes()->sidebar_size }}"
    data-sidebar-color="{{ SiteHelper::themes()->sidebar_color }}" data-layout-width="{{ SiteHelper::themes()->width }}"
    data-layout-menu-position="{{ SiteHelper::themes()->menu_position }}"
    data-sidebar-showuser="{{ SiteHelper::themes()->sidebar_showuser }}"
    data-topbar-color="{{ SiteHelper::themes()->topbar_color }}">

    <!-- Begin page -->
    <div id="wrapper">

        @include('layouts.backend.topbar')

        @include('layouts.backend.sidebar')

        <div class="content-page">

            @yield('content')


            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            2022 - <script>
                                document.write(new Date().getFullYear())
                            </script> &copy; {{ setting('1')->app_name }}
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-right footer-links d-none d-sm-block">
                                <a href="javascript:void(0);">About Us</a>
                                <a href="javascript:void(0);">Help</a>
                                <a href="javascript:void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

    </div>
    <!-- END wrapper -->
    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor js -->
    <script src="{{ asset('assets') }}/js/vendor.min.js"></script>

    <!-- Plugins js-->
    <script src="{{ asset('assets') }}/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('assets') }}/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('assets') }}/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('assets') }}/libs/select2/js/select2.min.js"></script>

    @stack('js-scripts')

    <!-- Sweet Alerts js -->
    <script src="{{ asset('assets') }}/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- App js-->
    <script src="{{ asset('assets') }}/js/app.min.js"></script>
    @stack('page-scripts')

    {!! SiteHelper::seo_setting()->costum_js !!}
    @if (SiteHelper::seo_setting()->is_active == true)

    {{ SiteHelper::seo_setting()->addthis_script }}
    {{ SiteHelper::seo_setting()->addthis_toolbox_code }}

    @endif
</body>

</html>