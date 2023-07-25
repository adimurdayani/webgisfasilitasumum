@push('page-scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });
    
    $(document).ready(function(){
        function load_data(){
            $('#table-role').DataTable({
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
                    url: '{{ route("app.roles.load-data") }}',
                    cache:false,
                },
                columns: [
                    { "data": null,"sortable": false, className:'text-center',render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    } },
                    { data: 'name', name: 'name' },
                    { data: 'roles', name: 'roles', render:function(data,row,value){
                        let html ='';
                        for (let index = 0; index < value.permissions.length; index++) {
                            html += '<div class="badge badge-secondary">'+value.permissions[index].name+'</div> ';                            
                        }
                        return html;   
                    } },
                    { data: 'id.deletable', name: 'id.deletable', className:'text-center', render:function(data,row,value){
                        if (value.deletable == false) {                            
                            return '<div class="btn-group">'+
                                        '<a href="/app/role/'+value.id+'/sitemap" class="btn btn-sm btn-success"><i class="mdi mdi-map-check"></i></a>'+
                                        '<a href="/app/role/'+value.id+'/edit-role" class="btn btn-sm btn-warning"><i class="fe-edit"></i></a>'+
                                    '</div>';
                        }else{
                            return '<div class="btn-group">'+
                                        '<a href="/app/role/'+value.id+'/sitemap" class="btn btn-sm btn-success"><i class="mdi mdi-map-check"></i></a>'+
                                        '<a href="/app/role/'+value.id+'/edit-role" class="btn btn-sm btn-warning"><i class="fe-edit"></i></a>'+
                                        '<button type="button" class="btn btn-sm btn-danger hapus-data" data-id="'+value.id+'"><i class="mdi mdi-trash-can"></i></button>'+
                                    '</div>';
                        }
                    } },
                ],          
                search: {
                    "regex": true
                },
                "order": [[ 3, "desc" ]]
            });

            $("#table-role").on('click','.hapus-data[data-id]',function(e){
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
                            url: "{{ route('app.roles.destroy') }}",
                            type: 'DELETE',
                            dataType: "JSON",
                            data: {
                                "id": id,
                            },
                            success: function (response){
                                if (response.success) {
                                    $('#table-role').DataTable().ajax.reload();
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
        }

        load_data();
        $('[data-toggle="select2"]').select2();
        
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