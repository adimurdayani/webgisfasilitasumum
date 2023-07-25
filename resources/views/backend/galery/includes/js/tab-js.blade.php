@push('page-scripts')
<script>
    $(document).ready(function(){
        $('#table-tabgalery').DataTable({
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
                url: '{{ route("app.tabs.load-data") }}',
                cache:false,
            },
            columns: [
                { "data": null,"sortable": false, className:'text-center',render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } },
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description'},
                { data: 'created_at', name: 'created_at'},
                { data: 'id', name: 'id', className:'text-center', render:function(data,row,value){
                    return '<div class="btn-group">'+
                                '<a href="#" class="btn btn-sm btn-warning edit-data" data-id="'+value.id+'"><i class="fe-edit"></i></a>'+
                                '<button type="button" class="btn btn-sm btn-danger hapus-data" data-id="'+value.id+'"><i class="mdi mdi-trash-can"></i></button>'+
                            '</div>';
                } },
            ],          
            search: {
                "regex": true
            },
        });

        $("#table-tabgalery").on('click','.edit-data[data-id]',function(e){
            $('#edit').modal('show');
            var id = $(this).data("id");
            $.ajax({
                url: "{{ route('app.tabs.show-edit') }}",
                type: 'GET',
                dataType: "JSON",
                data: {
                    "id": id,
                },
                success: function (response){
                    $('input[id="name"]').val(response.name);
                    $('textarea[id="description"]').val(response.description);
                    $('input[id="id"]').val(response.id);
                }
            });
        });

        $("#table-tabgalery").on('click','.hapus-data[data-id]',function(e){
            e.preventDefault();
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
                        url: "{{ route('app.tabs.delete') }}",
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
                                $('#table-tabgalery').DataTable().ajax.reload();
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

        $('.simpan').on('click',function(e){
            e.preventDefault();
            var name = $('input[name="name"]').val();
            var description = $('textarea[name="description"]').val();
            if (name == '') {
                Swal.fire({
                    title:"Error!",
                    text:"Field name is required!",
                    type:"error",
                    timer:1000
                });
                $('#tambah').modal('show');
            }else{
                $.ajax({
                    url: "{{ route('app.tabs.create') }}",
                    type: 'POST',
                    dataType: "JSON",
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    },
                    data: {
                        "name": name,
                        "description": description,
                    },
                    success: function (response){
                        if (response.success) {
                            $('#table-tabgalery').DataTable().ajax.reload();
                            $('input[name="name"]').val('');
                            $('input[textarea="description"]').val('');
                            $('#tambah').modal('hide');
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
            }
            
        })
        $('.update').on('click',function(e){
            e.preventDefault();
            var id = $('input[id="id"]').val();
            var name = $('input[id="name"]').val();
            var description = $('textarea[id="description"]').val();
            if (name == '') {
                Swal.fire({
                    title:"Error!",
                    text:"Field name is required!",
                    type:"error",
                    timer:1000
                });
                $('#edit').modal('show');
            }else{
                $.ajax({
                    url: "{{ route('app.tabs.edit') }}",
                    type: 'POST',
                    dataType: "JSON",
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    },
                    data: {
                        "id": id,
                        "name": name,
                        "description": description,
                    },
                    success: function (response){
                        if (response.success) {
                            $('#table-tabgalery').DataTable().ajax.reload();
                            $('input[id="name"]').val('');
                            $('textarea[id="description"]').val('');
                            $('#edit').modal('hide');
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
            }
            
        })
    });

</script>
@endpush