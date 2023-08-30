<!-- sample modal content -->
<div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{__('Create New')}} @yield('title')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body p-4">

                <div class="form-group">
                    <label for="title" class="control-label">{{__('Title')}} <span class="text-danger">*</span></label>
                    <input type="text" id="title" class="form-control" placeholder="Enter title" autofocus>
                </div>

                <div class="form-group">
                    <label for="description" class="control-label">{{__('Description')}}</label>
                    <textarea id="description" class="form-control" cols="30" rows="5"></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect"
                    data-dismiss="modal">{{__('Close')}}</button>
                <button type="button" class="btn btn-success waves-effect waves-light simpan">{{__('Save')}}</button>
            </div>
        </div>
    </div>
</div><!-- /.modal -->