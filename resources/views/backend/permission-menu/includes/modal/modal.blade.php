<!-- sample modal content -->
<div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Create New') }} @yield('title')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="{{ route('app.permissions.create') }}" method="post">
                @csrf
                <div class="modal-body p-4">

                    <div class="form-group">
                        <label for="module_id" class="control-label">{{ __('Module') }} <span
                                class="text-danger">*</span></label>
                        <select name="module_id" class="form-control @error('module_id') is-invalid @enderror"
                            data-toggle="select2">
                            @foreach ($modules as $module)
                            <option value="{{ $module->id }}">{{ $module->name }}</option>
                            @endforeach
                        </select>

                        @error('module_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name" class="control-label">{{ __('Permission Name') }} <span
                                class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            id="name" placeholder="Enter permission name" value="{{ old('name') }}" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="slug" class="control-label">{{ __('Slug') }} <span
                                class="text-danger">*</span></label>
                        <input type="text" name="slug" value="{{ old('slug') }}"
                            class="form-control @error('slug') is-invalid @enderror" id="slug" placeholder="Enter slug">

                        @error('slug')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">{{ __('Close')
                        }}</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->

<!-- sample modal content -->
@foreach ($permissions as $permission)
<div id="edit{{ $permission->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{__('Edit')}} @yield('title')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="{{ route('app.permissions.update',$permission->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">

                    <div class="form-group">
                        <label for="module_id" class="control-label">{{ __('Module') }} <span
                                class="text-danger">*</span></label>
                        <select name="module_id" id="module_id"
                            class="form-control @error('module_id') is-invalid @enderror" data-toggle="select2">
                            @foreach ($modules as $module)
                            <option value="{{ $module->id }}" {{ $permission->module_id == $module->id ? 'selected' : ''
                                }}>{{ $module->name }}</option>
                            @endforeach
                        </select>

                        @error('module_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name" class="control-label">{{ __('Permission Name') }} <span
                                class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            placeholder="Enter nama permission" autofocus value="{{ $permission->name }}">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="slug" class="control-label">{{ __('Slug') }} <span
                                class="text-danger">*</span></label>
                        <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                            placeholder="Enter slug" value="{{ $permission->slug }}">

                        @error('slug')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">{{ __('Close')
                        }}</button>
                    <button type="submit" class="btn btn-warning waves-effect waves-light ">{{ __('Save Change')
                        }}</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->
@endforeach