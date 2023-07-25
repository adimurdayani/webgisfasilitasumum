@push('js-scripts')
<script src="{{ asset('assets') }}/libs/x-editable/bootstrap-editable/js/bootstrap-editable.min.js"></script>
<script src="{{ asset('assets/') }}/libs/select2/js/select2.min.js"></script>
@endpush

@push('page-scripts')
<script type="text/javascript">
    $('#table-country').DataTable({
        language:
        {
            paginate:
            {
                previous:"<i class='mdi mdi-chevron-left'>",
                next:"<i class='mdi mdi-chevron-right'>"
            },
            processing: '<div class="spinner-border text-success m-2" role="status"></div>'
        },
        drawCallback:function(){
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
        },
        "aLengthMenu": [
            [5,10, 25, 50, 100, 200, -1],
            [5,10, 25, 50, 100, 200, "All"]
        ],
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("app.countries.load-data") }}',
            cache:false,
        },
        columns: [
            { "data": null,"sortable": false, className:'text-center',render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            } },
            { data: 'name', name: 'name' },
            { data: 'code', name: 'code',className:'text-center' },
            { data: 'status_lang', name: 'status_lang',className:'text-center'},
            { data: 'created_at', name: 'created_at',className:'text-center'},
            { data: 'id', name: 'id', className:'text-center', render:function(data,row,value){
                return '<div class="btn-group">'+
                            '<a href="/app/setting/country/'+value.id+'/edit" class="btn btn-sm btn-warning"><i class="fe-edit"></i></a>'+
                            '<button type="button" class="btn btn-sm btn-danger hapus-data" data-id="'+value.id+'"><i class="mdi mdi-trash-can"></i></button>'+
                        '</div>';
            } },
        ],          
        search: {
            "regex": true
        },
    });
        
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });

    $.fn.editable.defaults.mode = 'inline';
    $.fn.editableform.buttons='<button type="submit" class="btn btn-primary editable-submit btn-sm waves-effect waves-light"><i class="mdi mdi-check"></i></button><button type="button" class="btn btn-danger editable-cancel btn-sm waves-effect"><i class="mdi mdi-close"></i></button>';
    
    $('.translate').editable({
        params: function(params) {
            params.code = $(this).editable().data('code');
            return params;
        }
    });

    $('.translate-key').editable({
        validate: function(value) {
            if($.trim(value) == '') {
                return 'Key is required';
            }
        }
    });

    $('body').on('click', '.remove-key', function(){
        var cObj = $(this);

        Swal.fire({
                title:"Are you sure want to remove this item?",
                text:"You will delete the data permanently!",
                type:"warning",
                showCancelButton:!0,
                confirmButtonText:"Yes, delete it!",
                cancelButtonText:"No, cancel!",
                confirmButtonClass:"btn btn-sm btn-success mt-2",                    
                cancelButtonClass:"btn btn-sm btn-danger ml-2 mt-2",
                buttonsStyling:!1
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: cObj.data('action'),
                    method: 'DELETE',
                    success: function (response){
                        cObj.parents("tr").remove();
                        Swal.fire({
                            title:"Sukses!",
                            text:"Your imaginary file has been deleted.",
                            type:"success",
                            timer:700
                        });
                    }
                });
            } else if (result.dismiss === swal.DismissReason.cancel) {

            }

        })
    });
    
    $('[data-toggle="select2"]').select2();

    $(document).ready(function(){
        $("#table-country").on('click','.hapus-data[data-id]',function(e){
            e.preventDefault();
            var id = $(this).data("id");
            Swal.fire({
                title:"Are you sure want to remove this item?",
                text:"You will delete the data permanently!",
                type:"warning",
                showCancelButton:!0,
                confirmButtonText:"Yes, delete it!",
                cancelButtonText:"No, cancel!",
                confirmButtonClass:"btn btn-sm btn-success mt-2",                    
                cancelButtonClass:"btn btn-sm btn-danger ml-2 mt-2",
                buttonsStyling:!1
            }).then((result)=>{
                if (result.value) {
                    $.ajax({
                        url: "{{ route('app.countries.delete') }}",
                        type: 'DELETE',
                        dataType: "JSON",
                        headers: {
                            'X-CSRF-TOKEN': '{{csrf_token()}}'
                        },
                        data: {
                            "id": id,
                        },
                        success: function (response){
                            if (response.success) {
                                $('#table-country').DataTable().ajax.reload();
                                Swal.fire({
                                    title:"Sukses!",
                                    text:response.success,
                                    type:"success",
                                    timer:700
                                });
                            }else{
                                Swal.fire({
                                    title:"Error!",
                                    text:response.error,
                                    type:"error",
                                    timer:1000
                                });
                            }
                        }
                    });
                }else if (result.dismiss === swal.DismissReason.cancel) {}

            })
        });   
    })

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
        })
    @endif
</script>
@endpush