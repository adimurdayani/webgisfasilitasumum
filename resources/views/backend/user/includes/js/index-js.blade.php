@push('js-scripts')
<script src="{{ asset('assets') }}/libs/jquery-tabledit/jquery.tabledit.min.js"></script>
<script src="{{ asset('assets') }}/libs/x-editable/bootstrap-editable/js/bootstrap-editable.min.js"></script>
@endpush

@push('page-scripts')
<script>
    $(document).ready(function(){
        function load_data(){
            $('#table-user').DataTable({
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
                    url: '{{ route("app.users.load-data") }}',
                    cache:false,
                },
                columns: [
                    { data: 'id', name: 'id', className:'text-hide'},
                    { "data":null,"sortable": false, className:'text-center',render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    } },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'status', name: 'status', className:'text-center', render:function(data){
                        if (data == 1) {
                            return '<input type="checkbox" disabled checked>'
                        }else{
                            return '<input type="checkbox" disabled>'
                        }
                    } },
                    { data: 'id', name: 'id', className:'text-center', render:function(data){
                        return '<div class="btn-group">'+
                                    '<a href="user/'+data+'/user-edit" class="btn btn-sm btn-warning"><i class="fe-edit"></i> Edit</a>'+
                                    '<button type="button" class="btn btn-sm btn-danger hapus-data" data-id="'+data+'"><i class="mdi mdi-trash-can"></i> Hapus</button>'+
                                '</div>';
                    } },
                ],          
                search: {
                    "regex": true
                },
                "order": [[ 5, "desc" ]]
            });

            
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
            });

             //inline edit table
             $('#table-user').on('draw.dt', function() {
                $("#table-user").Tabledit({
                    url: '{{ route("app.users.edittable") }}',
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
                                confirmButtonClass:"btn btn-sm btn-confirm mt-2"
                            })
                            $('#table-user').DataTable().ajax.reload();
                       }else{
                            Swal.fire({
                                title:"Gagal!",
                                text:"Email tidak boleh sama.",
                                type:"error",
                                confirmButtonClass:"btn btn-sm btn-confirm mt-2"
                            })
                            $('#table-user').DataTable().ajax.reload();
                       }
                    },
                    columns: {
                        identifier: [0, "id"],
                        editable: [
                            [2, "name"],
                            [3, "email"]
                        ]
                    }
                });
            });


            $("#table-user").on('click','.hapus-data[data-id]',function(e){
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
                            url: "app/user/"+id+"/user-delete",
                            type: 'DELETE',
                            dataType: "JSON",
                            success: function (response){
                                if (response.success) {
                                    $('#table-user').DataTable().ajax.reload();
                                    Swal.fire({
                                        title:"Sukses!",
                                        text:response.success,
                                        type:"success",
                                        confirmButtonClass:"btn btn-sm btn-confirm mt-2"
                                    });
                                }else{
                                    Swal.fire({
                                        title:"Gagal!",
                                        text:response.error,
                                        type:"error",
                                        confirmButtonClass:"btn btn-sm btn-confirm mt-2"
                                    });
                                }
                            }
                        });
                    }else if (result.dismiss === swal.DismissReason.cancel) {}

                })
            });
        }

        load_data();

        
        @if(Session::has('error'))
            Swal.fire({
                title:"Error!",
                text:"{{ session('error') }}",
                type:"error",
                timer:700
            })
        @endif
    });
</script>
@endpush