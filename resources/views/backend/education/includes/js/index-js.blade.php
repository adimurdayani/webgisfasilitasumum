@push('page-scripts')
<script>
    $(document).ready(function(){
        $('#table-education').DataTable({
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
                url: '{{ route("app.educations.load-data") }}',
                cache:false,
            },
            columns: [
                { "data": null,"sortable": false, className:'text-center',render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } },
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description' },
                { data: 'created_at', name: 'created_at',className:'text-center'},
                { data: 'id', name: 'id', className:'text-center', render:function(data,row,value){
                    return '<div class="btn-group">'+
                                '<button type="button" class="btn btn-sm btn-warning edit-data" data-id="'+value.id+'"><i class="fe-edit"></i></button>'+
                                '<button type="button" class="btn btn-sm btn-danger hapus-data" data-id="'+value.id+'"><i class="mdi mdi-trash-can"></i></button>'+
                            '</div>';
                } },
            ],          
            search: {
                "regex": true
            },
        });

        $("#table-education").on('click','.hapus-data[data-id]',function(e){
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
                        url: "{{ route('app.educations.delete') }}",
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
                                $('#table-education').DataTable().ajax.reload();
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

        $(".simpan").on('click',function(e){
            e.preventDefault();
            var name = $('input[name="name"]').val();
            var description = $('textarea[name="description"]').val();

            if (name == '') {
                Swal.fire({
                    title:"Error!",
                    text:'Name is required!',
                    type:"error",
                    timer:1000
                });
            }else{
                $.ajax({
                    url: "{{ route('app.educations.create') }}",
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
                            $('#table-education').DataTable().ajax.reload();
                            $('#tambah').modal('hide');
                            $('input[name="name"]').val('');
                            $('textarea[name="description"]').val('');
                            Swal.fire({
                                title:"Sukses!",
                                text:response.success,
                                type:"success",
                                timer:700
                            });
                        }else{
                            console.log(response.error);
                            Swal.fire({
                                title:"Error!",
                                text:response.error.name,
                                type:"error",
                                timer:1000
                            });
                        }
                    }
                });
            }
        });

        $("#table-education").on('click','.edit-data[data-id]',function(e){
            e.preventDefault();
            $('#edit').modal('show');
            var id = $(this).data("id");

            $.ajax({
                url: "{{ route('app.educations.show') }}",
                type: 'GET',
                dataType: "JSON",
                data: {
                    "id": id
                },
                success: function (response){
                    $('input[id="id"]').val(response.id);
                    $('input[id="name"]').val(response.name);
                    $('textarea[id="description"]').val(response.description);
                }
            });
        });   
        
        $(".update").on('click',function(e){
            e.preventDefault();
            var id = $('input[id="id"]').val();
            var name = $('input[id="name"]').val();
            var description = $('textarea[id="description"]').val();

            if (name == '') {
                Swal.fire({
                    title:"Error!",
                    text:'Name is required!',
                    type:"error",
                    timer:1000
                });
            }else{
                $.ajax({
                    url: "{{ route('app.educations.edit') }}",
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
                            $('#table-education').DataTable().ajax.reload();
                            $('#edit').modal('hide');
                            $('input[id="id"]').val('');
                            $('input[id="name"]').val('');
                            $('textarea[id="description"]').val('');
                            Swal.fire({
                                title:"Sukses!",
                                text:response.success,
                                type:"success",
                                timer:700
                            });
                        }else{
                            console.log(response.error);
                            Swal.fire({
                                title:"Error!",
                                text:response.error.name,
                                type:"error",
                                timer:1000
                            });
                        }
                    }
                });
            }
        });

        
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