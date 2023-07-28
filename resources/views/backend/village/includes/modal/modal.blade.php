<!-- sample modal content -->
<div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kelurahan/Desa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="addForm" action="{{ route('app.villages.create') }}" method="post">
                @csrf
                <div class="modal-body p-4">

                    <div class="form-group">
                        <label for="name" class="control-label">Name <span class="text-danger">*</span></label>
                        <select name="region_id" class="form-control select2">
                            <option value="">-- Pilih --</option>
                            @foreach ($regions as $region)
                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name" class="control-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Enter name" autofocus>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light simpan">Save</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->

<!-- sample modal content -->
<div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Kelurahan/Desa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="editForm" action="{{route('app.villages.update')}}" method="post">
                @csrf
                <div class="modal-body p-4">

                    <input type="hidden" name="id">

                    <div class="form-group">
                        <label for="name" class="control-label">Name <span class="text-danger">*</span></label>
                        <select name="region_id" class="form-control select2">
                            @foreach ($regions as $region)
                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name" class="control-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Enter name" autofocus>
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