@push('js-scripts')
<script src="{{ asset('assets') }}/libs/select2/js/select2.min.js"></script>
@endpush

@push('page-scripts')
<script>
    $(document).ready(function(){
        $('#table-village').DataTable({
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
                url: '{{ route("app.villages.load-data") }}',
                cache:false,
            },
            columns: [
                { "data": null,"sortable": false, className:'text-center',render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } },
                { data: 'region', name: 'region' },
                { data: 'name', name: 'name' },
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

        $("#table-village").on('click','.hapus-data[data-id]',function(e){
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
                        url: "{{ route('app.villages.delete') }}",
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
                                $('#table-village').DataTable().ajax.reload();
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

        $("#addForm").on('submit',function(e){
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: "{{ route('app.villages.create') }}",
                type: 'POST',
                dataType: "JSON",
                processData: false,
                contentType: false,
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                data: formData,
                success: function (response){
                    if (response.success) {
                        $('#table-village').DataTable().ajax.reload();
                        $('#tambah').modal('hide');
                        $("#addForm")[0].reset();
                        Swal.fire({
                            title:"Sukses!",
                            text:response.success,
                            type:"success",
                            timer:700
                        });
                    }else{
                        let errorMessage = response.error && response.error.name ? response.error.name[0] : "Something went wrong!";
                        console.log(response.error);
                        Swal.fire({
                            title:"Error!",
                            text:errorMessage,
                            type:"error",
                            timer:1000
                        });
                    }
                }
            });
        });

        $("#table-village").on('click','.edit-data[data-id]',function(e){
            e.preventDefault();
            $('#edit').modal('show');
            var id = $(this).data("id");

            $.ajax({
                url: "/app/village/"+id+"/edit",
                type: 'GET',
                dataType: "JSON",
                success: function (response){
                    $('input[name="id"]').val(response.id);
                    $('input[name="name"]').val(response.name);
                    $('select[name="region_id"]').append('<option value="'+response.region_id+'" selected>'+response.region.name+'</option>');
                }
            });
        });   
        
        $("#editForm").on('submit',function(e){
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: "{{ route('app.villages.update') }}",
                type: 'POST',
                dataType: "JSON",
                processData: false,
                contentType: false,
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                data: formData,
                success: function (response){
                    if (response.success) {
                        $('#table-village').DataTable().ajax.reload();
                        $('#edit').modal('hide');
                        $("#editForm")[0].reset();
                        Swal.fire({
                            title:"Sukses!",
                            text:response.success,
                            type:"success",
                            timer:700
                        });
                    }else{
                        let errorMessage = response.error && response.error.name ? response.error.name[0] : "Something went wrong!";
                        console.log(response.error);
                        Swal.fire({
                            title:"Error!",
                            text:errorMessage,
                            type:"error",
                            timer:1000
                        });
                    }
                }
            });
        });
        
        @if(Session::has('error'))
            Swal.fire({
                title:"Error!",
                text:"{{ session('error') }}",
                type:"error",
                timer:700
            })
        @endif

        $('.select2').select2()
    });

</script>
@endpush