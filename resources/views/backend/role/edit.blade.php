@extends('layouts.backend.admin')
@section('title','Form Role')

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

        <form action="{{ route('app.roles.update',$role->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box ribbon-box">
                        <div class="ribbon ribbon-warning float-left"><i class="mdi mdi-plus mr-1"></i>
                            Create New Role
                        </div>

                        <div class="float-right mt-0">
                            <a href="{{ route('app.roles.index') }}" class="text-secondary"><i class="fe-list"></i>
                                List Role</a>
                        </div>

                        <div class="ribbon-content">
                            <div class="form-group mb-3">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" placeholder="Enter name"
                                    value="{{ $role->name }}" class="form-control @error('name') is-invalid @enderror">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="description">Description </label>
                                <textarea name="description" id="description" cols="30" rows="5" class="form-control"
                                    placeholder="Enter description"></textarea>
                            </div>

                        </div>

                    </div> <!-- end card-box -->
                </div>

            </div> <!-- container -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box ribbon-box">
                        <div class="ribbon ribbon-warning float-left"><i class="mdi mdi-plus mr-1"></i>
                            Manage Permission Pages for Role
                        </div>
                        <div class="float-right mt-0">
                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="select-all">
                                <label class="custom-control-label" for="select-all">Select All</label>
                            </div>
                        </div>
                        <div class="ribbon-content">

                            <h4 class="header-title text-center">Permission Pages</h4>
                            <hr>

                            @error('permissions')
                            <div class="alert alert-danger alert-dismissible fade show mb-3 mt-3" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ $message }}
                            </div>
                            @enderror

                            @forelse ($modules->chunk(3) as $key => $chunk)

                            <div class="form-row">
                                @foreach ($chunk as $key => $module)

                                <div class="col">
                                    <h4 class="header-title mt-5 mt-sm-0">{{ $module->name }}</h4>

                                    @foreach ($module->permissions as $permission)
                                    <div class="mt-3">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox" class="custom-control-input"
                                                id="permission-{{ $permission->id }}" name="permissions[]"
                                                value="{{ $permission->id }}" @isset($role) @foreach ($role->permissions
                                            as $item)
                                            {{ $permission->id == $item->id ? 'checked' :
                                            '' }}
                                            @endforeach
                                            @endisset
                                            >
                                            <label class="custom-control-label"
                                                for="permission-{{ $permission->id }}">{{
                                                $permission->name }}</label>
                                        </div>
                                    </div>
                                    @endforeach

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


                            <div class="text-right">
                                <button class="btn btn-rounded btn-warning" type="submit"><i class="fe-save"></i> Save
                                    Changes</button>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </form>

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box ribbon-box">
                    <div class="ribbon ribbon-warning float-left"><i class="mdi mdi-plus mr-1"></i>
                        Manage Permission Menus for Role
                    </div>
                    <div class="ribbon-content">

                        <h4 class="header-title text-center">Permission Menus</h4>
                        <hr>

                        <form action="{{ route('app.roles.create-access-menu',$role->id) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="menu">Menu <span class="text-danger">*</span></label>
                                        <select name="menu_id" id="menu_id" class="form-control" data-toggle="select2">
                                            <option value="">-- Select Menu --</option>
                                            @foreach ($menus as $m)
                                            <option value="{{ $m->id }}">{{ $m->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('menu_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="submenu_id">Sub Menu <span class="text-danger">*</span></label>
                                        <select name="submenu_id" class="form-control" data-toggle="select2">
                                        </select>

                                        @error('submenu_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="menuitem_id">Menu Item <span class="text-danger">*</span></label>
                                        <select name="menuitem_id" class="form-control" data-toggle="select2">
                                        </select>

                                        @error('menuitem_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <button class="btn btn-sm btn-rounded btn-warning" type="submit"><i class="fe-save"></i>
                                    Save Changes</button>
                            </div>
                        </form>

                        <h4 class="header-title text-center">Struktur Role Menu Access</h4>
                        <hr>


                        <div data-spy="scroll" data-target="#navbar-example3" data-offset="0" class="scrollspy-example"
                            style="height: 350px;">

                            @forelse ($menus->chunk(3) as $key => $chunk)

                            <div class="form-row">
                                @foreach ($chunk as $key => $menu)

                                <div class="col">
                                    <ul>
                                        <li>
                                            <div class="custom-control custom-checkbox mb-2">

                                                <input type="checkbox" class="custom-control-input"
                                                    id="menu-{{ $menu->id }}" name="menus" value="{{ $menu->id }}"
                                                    @isset($role) @foreach (SiteHelper::role_access($role->id)
                                                as $accessmenu)
                                                {{ $accessmenu->menu_id == $menu->id ? 'checked disabled' :'disabled' }}
                                                @endforeach
                                                @endisset disabled>

                                                <label class="custom-control-label" for="menu-{{ $menu->id }}">{{
                                                    $menu->name }}
                                                </label>

                                            </div>
                                        </li>
                                        <ul>
                                            @foreach ($menu->subMenus as $submenu)
                                            <li>
                                                <div class="custom-control custom-checkbox mb-2">
                                                    <input type="checkbox" class="custom-control-input" @isset($role)
                                                        @foreach (SiteHelper::role_access($role->id) as $accessmenu)
                                                    {{ $accessmenu->submenu_id == $submenu->id ? 'checked disabled'
                                                    :'' }}
                                                    @endforeach
                                                    @endisset
                                                    disabled
                                                    id="menu-{{ $submenu->id }}" name="submenus"
                                                    value="{{ $submenu->id }}">
                                                    <label class="custom-control-label"
                                                        for="submenu-{{ $submenu->id }}">{{
                                                        $submenu->title }}
                                                    </label>
                                                </div>
                                            </li>
                                            <ul>
                                                @foreach ($submenu->menuItems as $item)
                                                <li>
                                                    <div class="custom-control custom-checkbox mb-2">
                                                        <input type="checkbox" class="custom-control-input"
                                                            @isset($role) @foreach (SiteHelper::role_access($role->id)
                                                        as $accessmenu)
                                                        {{ $accessmenu->menuitem_id == $item->id ? 'checked disabled'
                                                        :'' }}
                                                        @endforeach
                                                        @endisset
                                                        disabled
                                                        id="item-{{ $item->id }}" name="items"
                                                        value="{{ $item->id }}">
                                                        <label class="custom-control-label"
                                                            for="item-{{ $item->id }}">{{
                                                            $item->title }}
                                                        </label>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endforeach
                                        </ul>
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

@include('backend.role.includes.edit-js')