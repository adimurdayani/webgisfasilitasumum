@push('page-scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });
    
    $(document).ready(function(){
        $('#table-subcategory').DataTable({
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
                url: '{{ route("app.subcategories.load-data") }}',
                cache:false,
            },
            columns: [
                { "data": null,"sortable": false, className:'text-center',render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } },
                { data: 'title', name: 'title' },
                { data: 'slug', name: 'slug' },
                { data: 'category', name: 'category' },       
                { data: 'created_at', name: 'created_at', className:'text-center' },                
                { data: 'id', name: 'id', className:'text-center', render:function(data,row,value){
                    return '<div class="btn-group">'+
                                    '<button type="button" class="btn btn-sm btn-blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Other <i class="mdi mdi-chevron-down"></i> </button>'+
                                    '<div class="dropdown-menu">'+
                                        '<a href="/app/sub-categories/'+value.id+'/edit" class="dropdown-item"><i class="fe-edit"></i> Edit</a>'+
                                        '<button type="button" class="dropdown-item hapus-data" data-id="'+value.id+'"><i class="mdi mdi-trash-can"></i> Delete</button>'+
                                    '</div>'+
                                '</div>';
                } },
            ],          
            search: {
                "regex": true
            },
            "order": [[ 3, "desc" ]]
        });

        $("#table-subcategory").on('click','.hapus-data[data-id]',function(e){
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
                        url: "{{ route('app.subcategories.destroy') }}",
                        type: 'DELETE',
                        dataType: "JSON",
                        data: {
                            "id": id,
                        },
                        success: function (response){
                            if (response.success) {
                                $('#table-subcategory').DataTable().ajax.reload();
                                Swal.fire({
                                    title:"Sukses!",
                                    text:response.success,
                                    type:"success",
                                    timer:700
                                });
                            }else{
                                Swal.fire({
                                    title:"Sukses!",
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

        $('.simpan').click(function(){
            var id_category = $('select[name="id_category"]').val();
            var title = $('input[name="title"]').val();
            var description = $('textarea[name="description"]').val();
            var keywords = $('input[name="keywords"]').val();

            if (title == "") {
                Swal.fire({
                    title:"Error!",
                    text:"Field title is required!",
                    type:"error",
                    timer:700
                });
            } else {
                $.ajax({
                    url: "{{ route('app.subcategories.create') }}",
                    type: 'POST',
                    dataType: "JSON",
                    data: {
                        "id_category": id_category,
                        "title": title,
                        "description": description,
                        "keywords": keywords,
                    },
                    success: function (response){
                        if (response.success) {
                            $('#table-subcategory').DataTable().ajax.reload();
                            $('#tambah').modal('hide');
                            $('input[name="title"]').val('');
                            $('input[name="keywords"]').val('');
                            $('textarea[name="description"]').val('');
                            Swal.fire({
                                title:"Sukses!",
                                text:response.success,
                                type:"success",
                                timer:700
                            });
                        }else{
                            console.log(response.errors);
                            Swal.fire({
                                title:"Error!",
                                text:response.errors.description,
                                type:"error",
                                timer:700
                            });
                        }
                    }
                });
            }
        });

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