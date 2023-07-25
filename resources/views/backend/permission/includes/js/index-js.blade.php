@push('js-scripts')
<script>
    $(document).ready(function(){
        $('#table-permission').DataTable({
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
                [10, 25, 50, 100, 200, -1],
                [10, 25, 50, 100, 200, "All"]
            ],
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("app.permissions.load-data") }}',
                cache:false,
            },
            columns: [
                { "data": null,"sortable": false, className:'text-center',render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } },
                { data: 'name', name: 'name', "sortable": true},
                { data: 'slug', name: 'slug', "sortable": true},
                { data: 'created_at', name: 'created_at', className:'text-center'},
                { data: 'id', name: 'id', className:'text-center', render:function(data){
                    return '<div class="btn-group">'+
                                '<a href="#" class="btn btn-sm btn-warning" data-target="#edit'+data+'" data-toggle="modal"><i class="fe-edit"></i> </a>'+
                                '<button type="button" class="btn btn-sm btn-danger hapus-data" data-id="'+data+'"><i class="mdi mdi-trash-can"></i> </button>'+
                            '</div>';
                } },
            ],          
            search: {
                "regex": true
            },
            "order": [[ 4, "desc" ]]
        });

        $("#table-permission").on('click','.hapus-data[data-id]',function(e){
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
                        url: "{{ route('app.permissions.destroy') }}",
                        type: 'DELETE',
                        dataType: "JSON",
                        data: {
                            "id": id,
                        },
                        success: function (response){
                            if (response.success) {
                                $('#table-permission').DataTable().ajax.reload();
                                Swal.fire({
                                    title:"Sukses!",
                                    text:response.success,
                                    type:"success",
                                    confirmButtonClass:"btn btn-sm btn-confirm mt-2"
                                });
                            }else{
                                Swal.fire({
                                    title:"Sukses!",
                                    text:response.error,
                                    type:"success",
                                    confirmButtonClass:"btn btn-sm btn-confirm mt-2"
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
                confirmButtonClass:"btn btn-sm btn-confirm mt-2"
            })
        @endif

        @if (count($errors) > 0)
            $('#tambah').modal('show');
        @endif

        
        @if(Session::has('error'))
            Swal.fire({
                title:"Error!",
                text:"{{ session('error') }}",
                type:"error",
                timer:700
            })
        @endif
    });

    $('[data-toggle="select2"]').select2();
</script>
@endpush