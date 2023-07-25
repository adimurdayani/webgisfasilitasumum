@push('js-scripts')
<script src="{{ asset('assets') }}/libs/x-editable/bootstrap-editable/js/bootstrap-editable.min.js"></script>
@endpush

@push('page-scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });
    $(document).ready(function(){
        $.fn.editable.defaults.mode = 'inline';
        $.fn.editableform.buttons='<button type="submit" class="btn btn-primary editable-submit btn-sm waves-effect waves-light"><i class="mdi mdi-check"></i></button><button type="button" class="btn btn-danger editable-cancel btn-sm waves-effect"><i class="mdi mdi-close"></i></button>';
        $(".inline-username").editable({
            url: "{{ route('app.settings.update') }}",
            type:"text",
            pk:1,
            name:"name",
            inputclass:"form-control-sm form-control"
        });

        @if(Session::has('success'))
            Swal.fire({
                title:"Sukses!",
                text:"{{ session('success') }}",
                type:"success",
                timer:700
            })
        @endif
        @if(Session::has('error'))
            Swal.fire({
                title:"Gagal!",
                text:"{{ session('error') }}",
                type:"error",
                timer:700
            })
        @endif
    });
</script>
@endpush