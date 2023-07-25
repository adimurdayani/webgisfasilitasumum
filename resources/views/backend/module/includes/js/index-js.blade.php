@push('js-scripts')
<script src="{{ asset('assets') }}/libs/jquery-tabledit/jquery.tabledit.min.js"></script>
<script src="{{ asset('assets') }}/libs/x-editable/bootstrap-editable/js/bootstrap-editable.min.js"></script>
@endpush

@push('page-scripts')
<script>
    $(document).ready(function(){
        $('#table-module').DataTable({
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
                url: '{{ route("app.modules.load-data") }}',
                cache:false,
            },
            columns: [
                { data: 'id', name: 'id', className:'text-hide'},
                { "data":null,"sortable": false, className:'text-center',render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } },
                { data: 'name', name: 'name' },
                { data: 'created_at', name: 'created_at' },
                { data: 'id', name: 'id', className:'text-center', render:function(data){
                    return '<div class="btn-group">'+
                                '<button type="button" class="btn btn-sm btn-danger hapus-data" data-id="'+data+'"><i class="fe-trash"></i></button>'+
                            '</div>';
                } },
            ],          
            search: {
                "regex": true
            },
            "order": [[ 4, "desc" ]]
        });

        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });

        //inline edit table
        $('#table-module').on('draw.dt', function() {
            $("#table-module").Tabledit({
                url: '{{ route("app.modules.editable") }}',
                dataType: 'json',
                cache: false,
                buttons: {
                    edit: {
                        class: "btn btn-success",
                        html: '<span class="mdi mdi-pencil"></span>',
                        action: "edit"
                    }
                },
                inputClass: "form-control",
                deleteButton: 1,
                saveButton: 1,
                autoFocus: !1,
                restoreButton: false,
                onSuccess: function(data) {
                    if (data.success) {
                        Swal.fire({
                            title:"Sukses!",
                            text:data.success,
                            type:"success",
                            timer:700
                        })
                        $('#table-module').DataTable().ajax.reload();
                    }else{
                        Swal.fire({
                            title:"Gagal!",
                            text:data.error,
                            type:"error",
                            timer:700
                        })
                        $('#table-module').DataTable().ajax.reload();
                    }
                },
                columns: {
                    identifier: [0, "id"],
                    editable: [
                        [2, "name"],
                    ]
                }
            });
        });


        $("#table-module").on('click','.hapus-data[data-id]',function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });

            var id = $(this).data("id");
            Swal.fire({
                title:"Apakah anda yakin?",
                text:"Anda akan menghapus data tersebut secara permanen!",
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
                        url: "{{ route('app.modules.destroy') }}",
                        type: 'DELETE',
                        data: {
                            "id": id,
                        },
                        dataType: "JSON",
                        success: function (response){
                            if (response.success) {
                                $('#table-module').DataTable().ajax.reload();
                                Swal.fire({
                                    title:"Sukses!",
                                    text:response.success,
                                    type:"success",
                                    timer:700
                                });
                            }else{
                                Swal.fire({
                                    title:"Gagal!",
                                    text:response.error,
                                    type:"error",
                                    timer:700
                                });
                            }
                        }
                    });
                }else if (result.dismiss === swal.DismissReason.cancel) {}

            })
        });

        @if(Session::has('success'))
            Swal.fire({
                title:"Sukses!",
                text:"{{ session('success') }}",
                type:"success",
                timer:700
            })
        @endif

        @if (count($errors) > 0)
            $('#tambah').modal('show');
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