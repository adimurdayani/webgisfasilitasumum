@push('page-scripts')
<script>
    $(document).ready(function(){
        $('#table-posts').DataTable({
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
                url: '{{ route("app.posts.load-data") }}',
                cache:false,
            },
            columns: [
                { "data": 'id', name:'id' ,"sortable": false, className:'text-center',render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } },
                { data: 'title_image'},
                { data: 'type', name: 'type', className:'text-center' },
                { data: 'category', name: 'category', className:'text-center', render:function(data){
                    return '<div class="badge badge-success">'+data+'</div>'; 
                } },
                { data: 'is_active.visibility', name: 'is_active.visibility', className:'text-center', render:function(data,row,value){                    
                    if (value.is_active == true) {
                        var element = '';
                        for (let index = 0; index < value.visibilities.length; index++) {
                            element += '<div class="badge badge-info ml-1">'+value.visibilities[index].description+'</div>' ;
                        }                        
                        return '<div class="badge badge-success ml-1">Show</div>'+ element;
                    }else{
                        var element = '';
                        for (let index = 0; index < value.visibilities.length; index++) {
                            element += '<div class="badge badge-info ml-1">'+value.visibilities[index].description+'</div>' ;
                        }                        
                        return '<div class="badge badge-success ml-2">Hide</div>'+ element;

                    }
                } },
                { data: 'publish', name: 'publish',className:'text-center' },                
                { data: 'views', name: 'views',className:'text-center' }, 
                { data: 'user_name', name: 'user_name' },               
                { data: 'created_at', name: 'created_at' },                
                { data: 'button', name: 'button', className:'text-center', orderable: false, searchable: false},
            ],          
            search: {
                "regex": true
            },
            "order": [[ 0, "desc" ]]
        });

        $("#table-posts").on('click','.hapus-data[data-id]',function(e){
            e.preventDefault();

            var id = $(this).data("id");
            Swal.fire({
                title:"{{ __('Are you sure?') }}",
                text:"{{ __('You will delete the data permanently!') }}",
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
                        url: "{{ route('app.posts.delete') }}",
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{csrf_token()}}'
                        },
                        dataType: "JSON",
                        data: {
                            "id": id,
                        },
                        success: function (response){
                            if (response.success) {
                                $('#table-posts').DataTable().ajax.reload();
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
                                    type:"success",
                                    timer:1000
                                });
                            }
                        }
                    });
                }else if (result.dismiss === swal.DismissReason.cancel) {}

            })
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