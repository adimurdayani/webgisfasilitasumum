@extends('layouts.backend.admin')
@section('title','Themes')

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
                <div class="card-box">
                    <h4 class="header-title text-uppercase bg-light p-2">Theme Settings</h4>

                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="header-title mt-3 mb-3">Color Scheme</h4>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" name="mode"
                                    value="{{ SiteHelper::themes()->mode }}" {{ SiteHelper::themes()->mode == 'light' ?
                                'checked':'' }}>
                                <label class="custom-control-label" for="customSwitch1">Light Mode</label>
                            </div>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" name="mode"
                                    value="{{ SiteHelper::themes()->mode }}" id="customSwitch2" {{
                                    SiteHelper::themes()->mode == 'dark' ? 'checked':'' }}>
                                <label class="custom-control-label" for="customSwitch2">Dark Mode</label>
                            </div>

                            <h4 class="header-title mt-3 mb-3">Width</h4>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch3" name="width"
                                    value="{{ SiteHelper::themes()->width }}" {{ SiteHelper::themes()->width == 'fluid'
                                ? 'checked':'' }}>
                                <label class="custom-control-label" for="customSwitch3">Fluid</label>
                            </div>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch4" name="width"
                                    value="{{ SiteHelper::themes()->width }}" {{ SiteHelper::themes()->width == 'boxed'
                                ? 'checked':'' }}>
                                <label class="custom-control-label" for="customSwitch4">Boxed</label>
                            </div>

                            <h4 class="header-title mt-3 mb-3">Menus (Leftsidebar and Topbar) Positon</h4>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch5"
                                    name="menu_position" value="{{ SiteHelper::themes()->menu_position }}" {{
                                    SiteHelper::themes()->menu_position == 'fixed'
                                ? 'checked':'' }}>
                                <label class="custom-control-label" for="customSwitch5">Fixed</label>
                            </div>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch6"
                                    name="menu_position" value="{{ SiteHelper::themes()->menu_position }}" {{
                                    SiteHelper::themes()->menu_position ==
                                'scrollable' ? 'checked':'' }}>
                                <label class="custom-control-label" for="customSwitch6">Scrollable</label>
                            </div>

                            <h4 class="header-title mt-3 mb-3">Left Sidebar Color</h4>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch7"
                                    name="sidebar_color" value="{{ SiteHelper::themes()->sidebar_color }}" {{
                                    SiteHelper::themes()->sidebar_color ==
                                'light' ? 'checked':'' }}>
                                <label class="custom-control-label" for="customSwitch7">Light</label>
                            </div>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch8"
                                    name="sidebar_color" value="{{ SiteHelper::themes()->sidebar_color }}" {{
                                    SiteHelper::themes()->sidebar_color == 'dark' ?
                                'checked':'' }}>
                                <label class="custom-control-label" for="customSwitch8">Dark</label>
                            </div>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch9"
                                    name="sidebar_color" value="{{ SiteHelper::themes()->sidebar_color }}" {{
                                    SiteHelper::themes()->sidebar_color == 'brand'
                                ? 'checked':'' }}>
                                <label class="custom-control-label" for="customSwitch9">Brand</label>
                            </div>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch10"
                                    name="sidebar_color" value="{{ SiteHelper::themes()->sidebar_color }}" {{
                                    SiteHelper::themes()->sidebar_color ==
                                'gradient' ? 'checked':'' }}>
                                <label class="custom-control-label" for="customSwitch10">Gradient</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h4 class="header-title mt-3 mb-3">Left Sidebar Size</h4>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch11"
                                    name="sidebar_size" value="default" {{ SiteHelper::themes()->sidebar_size ==
                                'default' ? 'checked':'' }}>
                                <label class="custom-control-label" for="customSwitch11">Default</label>
                            </div>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch12"
                                    name="sidebar_size" value="condensed" {{ SiteHelper::themes()->sidebar_size ==
                                'condensed' ? 'checked':'' }}>
                                <label class="custom-control-label" for="customSwitch12">Condensed <small
                                        class="text-muted">(Extra Small size)</small></label>
                            </div>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch13"
                                    name="sidebar_size" value="compact" {{ SiteHelper::themes()->sidebar_size ==
                                'compact' ? 'checked':'' }}>
                                <label class="custom-control-label" for="customSwitch13">Compact <small
                                        class="text-muted">(Small size)</small></label>
                            </div>

                            <h4 class="header-title mt-3 mb-3">Sidebar User Info</h4>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch14"
                                    name="sidebar_showuser" value="{{ SiteHelper::themes()->sidebar_showuser }}" {{
                                    SiteHelper::themes()->sidebar_showuser ==
                                'true' ? 'checked':'' }}>
                                <label class="custom-control-label" for="customSwitch14">Enable</label>
                            </div>

                            <h4 class="header-title mt-3 mb-3">Topbar</h4>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch15"
                                    name="topbar_color" value="dark" {{ SiteHelper::themes()->topbar_color == 'dark' ?
                                'checked':'' }}>
                                <label class="custom-control-label" for="customSwitch15">Dark</label>
                            </div>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch16"
                                    name="topbar_color" value="light" {{ SiteHelper::themes()->topbar_color == 'light' ?
                                'checked':'' }}>
                                <label class="custom-control-label" for="customSwitch16">Light </label>
                            </div>

                        </div>
                    </div>

                </div> <!-- end card-box -->
            </div>
        </div> <!-- container -->
    </div> <!-- content -->
</div> <!-- content -->
@endsection

@include('backend.themes.includes.index-js')