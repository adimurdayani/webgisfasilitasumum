<!-- sample modal content -->
<div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Menu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body p-4">

                <div class="form-group">
                    <label for="name" class="control-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Enter name" autofocus>
                </div>

                <div class="form-group">
                    <label for="description" class="control-label">Description</label>
                    <textarea name="description" class="form-control" cols="30" rows="5"></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success waves-effect waves-light simpan">Save</button>
            </div>
        </div>
    </div>
</div><!-- /.modal -->

<!-- sample modal content -->
<div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Menu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body p-4">

                <input type="hidden" id="id">

                <div class="form-group">
                    <label for="name" class="control-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" autofocus>
                </div>

                <div class="form-group">
                    <label for="description" class="control-label">Description</label>
                    <textarea name="description" id="description" class="form-control" cols="30" rows="5"></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning waves-effect waves-light update">Save Change</button>
            </div>
        </div>
    </div>
</div><!-- /.modal -->

<!-- sample modal content -->
<div id="tambah-submenu" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Sub Menu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="{{ route('app.submenus.create') }}" method="post">
                @csrf
                <div class="modal-body p-4">

                    <div class="form-group">
                        <label for="menu_id">Menu Parent <span class="text-danger">*</span></label>
                        <select name="menu_id" id="menu_id" class="form-control @error('menu_id') is-invalid @enderror"
                            data-toggle="select2">
                            @foreach ($menus as $menu)
                            <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                            @endforeach
                        </select>

                        @error('menu_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="title" class="control-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            placeholder="Enter title" autofocus value="{{ old('title') }}">

                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="url" class="control-label">URL</label>
                        <input type="text" name="url" class="form-control" placeholder="Enter rul"
                            value="{{ old('url') }}">
                    </div>

                    <div class="form-group">
                        <label for="target" class="control-label">Open In</label>
                        <select name="target" id="target" class="form-control">
                            <option value="_selft">Same Tab/Window</option>
                            <option value="_blank">New Tab/Window</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="order" class="control-label">Order</label>
                        <input type="number" name="order" class="form-control" placeholder="Enter order" value="1">
                    </div>

                    <div class="form-group">
                        <label for="icon" class="control-label">Icon <span class="text-danger">*</span></label>
                        <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror"
                            placeholder="Enter icon" value="{{ old('icon') }}">

                        @error('icon')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->

<!-- sample modal content -->
@foreach ($submenus as $submenu)
<div id="edit-submenu{{ $submenu->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Sub Menu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="{{ route('app.submenus.edit', $submenu->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">

                    <div class="form-group">
                        <label for="menu_id">Menu Parent <span class="text-danger">*</span></label>
                        <select name="menu_id" class="form-control" data-toggle="select2">
                            @foreach ($menus as $menu)
                            <option value="{{ $menu->id }}" {{ $submenu->menu_id == $menu->id ? 'selected' : ''
                                }}>{{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="title" class="control-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            placeholder="Enter title" autofocus value="{{ $submenu->title }}">

                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="url" class="control-label">URL</label>
                        <input type="text" name="url" class="form-control" placeholder="Enter url"
                            value="{{ $submenu->url }}">
                    </div>

                    <div class="form-group">
                        <label for="target" class="control-label">Open In</label>
                        <select name="target" id="target" class="form-control">
                            <option value="_selft" {{ $submenu->target == '_selft' ? 'selected' : '' }}>Same
                                Tab/Window</option>
                            <option value="_blank" {{ $submenu->target == '_blank' ? 'selected' : '' }}>New
                                Tab/Window</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="order" class="control-label">Order</label>
                        <input type="number" name="order" class="form-control " placeholder="Enter order"
                            value="{{ $submenu->order }}">
                    </div>

                    <div class="form-group">
                        <label for="icon" class="control-label">Icon <span class="text-danger">*</span></label>
                        <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror"
                            placeholder="Enter icon" value="{{ $submenu->icon }}">

                        @error('icon')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="collapse">Collapse Menu</label>
                        <select name="collapse" id="collapse" class="form-control">
                            <option value="collapse" {{ $submenu->collapse != null ? '' : 'selected' }}>Active
                            </option>
                            <option value="" {{ $submenu->collapse != null ? '' : 'selected' }}>Non-Active</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning waves-effect waves-light">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->
@endforeach

<!-- sample modal content -->
@foreach ($submenus as $submenu)
<div id="tambah-menuitem{{ $submenu->id }}" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Item Menu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="{{ route('app.itemmenu.create') }}" method="post">
                @csrf
                <div class="modal-body p-4">
                    <input type="hidden" name="menu_id" value="{{ $submenu->menu_id }}">
                    <input type="hidden" name="submenu_id" value="{{ $submenu->id }}">
                    <div class="form-group">
                        <label for="title" class="control-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            placeholder="Enter title" autofocus>

                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="url" class="control-label">URL</label>
                        <input type="text" name="url" class="form-control @error('url') is-invalid @enderror"
                            placeholder="Enter url">

                        @error('url')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="order" class="control-label">Order</label>
                        <input type="number" name="order" class="form-control @error('order') is-invalid @enderror"
                            value="1" placeholder="Enter order">

                        @error('order')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->
@endforeach

<!-- sample modal content -->
@foreach ($menuitems as $menuitem)
<div id="edit-menuitem{{ $menuitem->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Item Menu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="{{ route('app.itemmenu.edit',$menuitem->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="form-group">
                        <label for="title" class="control-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            placeholder="Enter title" autofocus value="{{ $menuitem->title }}">

                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="url" class="control-label">URL</label>
                        <input type="text" name="url" class="form-control @error('url') is-invalid @enderror"
                            placeholder="Enter url" value="{{ $menuitem->url }}">

                        @error('url')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="order" class="control-label">Order</label>
                        <input type="number" name="order" class="form-control @error('order') is-invalid @enderror"
                            placeholder="Enter order" value="{{ $menuitem->order }}">

                        @error('order')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning waves-effect waves-light">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->
@endforeach