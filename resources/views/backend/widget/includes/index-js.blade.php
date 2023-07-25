@push('page-scripts')
<script>
    $(document).ready(function(){
        $('#table-widget').DataTable({
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
                url: '{{ route("app.widgets.load-data") }}',
                cache:false,
            },
            columns: [
                { "data": null,"sortable": false, className:'text-center',render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } },
                { data: 'title', name: 'title' },
                { data: 'content_type', name: 'content_type'},
                { data: 'location', name: 'location'},
                { data: 'order', name: 'order',className:'text-center'},
                { data: 'status', name: 'status',className:'text-center'},
                { data: 'created_at', name: 'created_at',className:'text-center'},
                { data: 'id', name: 'id', className:'text-center', render:function(data,row,value){
                    return '<div class="btn-group">'+
                                '<a href="/app/widget/'+value.id+'/edit" class="btn btn-sm btn-warning edit-data"><i class="fe-edit"></i></a>'+
                                '<button type="button" class="btn btn-sm btn-danger hapus-data" data-id="'+value.id+'"><i class="mdi mdi-trash-can"></i></button>'+
                            '</div>';
                } },
            ],          
            search: {
                "regex": true
            },
        });

        $("#table-widget").on('click','.hapus-data[data-id]',function(e){
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
                        url: "{{ route('app.widgets.delete') }}",
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
                                $('#table-widget').DataTable().ajax.reload();
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