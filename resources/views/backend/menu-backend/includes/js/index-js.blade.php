@push('js-scripts')
<script src="{{ asset('assets') }}/libs/nestable2/jquery.nestable.min.js"></script>
@endpush

@push('page-scripts')
<script>
    $(document).ready(function(){
        $('#table-menu').DataTable({
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
                url: '{{ route("app.menus.load-data") }}',
                cache:false,
            },
            columns: [
                { "data": null,"sortable": false, className:'text-center',render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } },
                { data: 'name', name: 'name', render:function(data){
                    return '<code>'+data+'</code>'
                } },
                { data: 'description', name: 'description' },
                { data: 'deletable.id', name: 'deletable.id',className:'text-center',render:function(data,row,value){
                    if (value.deletable == true) {
                        return '<div class="custom-control custom-checkbox">'+
                                    '<input type="checkbox" class="custom-control-input" name="deletable" value="'+value.id+'" checked id="deletable-'+value.id+'">'+
                                    '<label class="custom-control-label" for="deletable-'+value.id+'">Active</label>'+
                                '</div>';
                    }else{
                        return '<div class="custom-control custom-checkbox">'+
                                    '<input type="checkbox" class="custom-control-input" name="deletable" value="'+value.id+'" id="deletable-'+value.id+'"">'+
                                    '<label class="custom-control-label" for="deletable-'+value.id+'"">Non-Active</label>'+
                                '</div>';
                    }
                } },
                { data: 'created_at', name: 'created_at',className:'text-center' },
                { data: 'id.deletable', name: 'id.deletable', className:'text-center', render:function(data,row,value){
                    if (value.deletable == true) {
                        return '<div class="btn-group">'+
                                        '<a href="menus/'+value.id+'/builder" class="btn btn-sm btn-info"><i class="fe-edit"></i> Builder</a>'+
                                        '<a href="#" class="btn btn-sm btn-warning edit" data-id="'+value.id+'"><i class="fe-edit"></i> Edit</a>'+
                                    '</div>';
                    }else{
                        return '<div class="btn-group">'+
                                        '<a href="menus/'+value.id+'/builder" class="btn btn-sm btn-info"><i class="fe-edit"></i> Builder</a>'+
                                        '<a href="#" class="btn btn-sm btn-warning edit" data-id="'+value.id+'"><i class="fe-edit"></i> Edit</a>'+
                                        '<button type="button" class="btn btn-sm btn-danger hapus-data" data-id="'+value.id+'"><i class="mdi mdi-trash-can"></i> Delete</button>'+
                                    '</div>';
                    }
                } },
            ],          
            search: {
                "regex": true
            },
            "order": [[ 4, "asc" ]]
        });

        $("#table-menu").on('click','input[name="deletable"]',function(e){
            var id = $(this).val();
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });

            $.ajax({
                url: "{{ route('app.menus.update-deletable') }}",
                type: 'POST',
                dataType: "JSON",
                data: {
                    "id": id
                },
                success: function (response){
                    if (response.success) {
                        $('#table-menu').DataTable().ajax.reload();
                    }else{
                        Swal.fire({
                            title:"Error!",
                            text:response.error,
                            type:"error",
                            buttons: false,
                            timer:700
                        });
                    }
                }
            });
        });

        $("#table-menu").on('click','.hapus-data[data-id]',function(e){
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
                        url: "{{ route('app.menus.destroy') }}",
                        type: 'DELETE',
                        dataType: "JSON",
                        data: {
                            "id": id,
                        },
                        success: function (response){
                            if (response.success) {
                                $('#table-menu').DataTable().ajax.reload();   
                                window.location.href='';                            
                                Swal.fire({
                                    title:"Sukses!",
                                    text:response.success,
                                    type:"success",
                                    buttons: false,
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

        $('.simpan').on('click',function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });
            var name = $('input[name="name"]').val();
            var description = $('textarea[name="description"]').val();
            var role_id = {{ Auth::user()->role_id }};

            $.ajax({
                url: "{{ route('app.menus.create') }}",
                type: 'POST',
                dataType: "JSON",
                data: {
                    "name": name,
                    "role_id": role_id,
                    "description": description,
                },
                success: function (response){
                    if (response.success) {
                        $('#table-menu').DataTable().ajax.reload();
                        window.location.href='';
                        Swal.fire({
                            title:"Sukses!",
                            text:response.success,
                            type:"success",
                            buttons: false,
                            timer:700
                        });
                        $('#tambah').modal('hide');
                        $('input[name="title"]').val('');
                        $('textarea[name="description"]').val('');
                    }else{
                        Swal.fire({
                            title:"Error!",
                            text:response.errors.title[0],
                            type:"error",
                            buttons: false,
                            timer:700
                        });
                    }
                }
            });
        });

        $("#table-menu").on('click','.edit[data-id]',function(e){
            $('#edit').modal('show');
            var id = $(this).data('id');

            $.ajax({
                url: "{{ route('app.menus.show') }}",
                type: 'GET',
                dataType: "JSON",
                data: {
                    "id": id,
                },
                success: function (response){
                    if (response.error) {
                        Swal.fire({
                            title:"Error!",
                            text:response.errors,
                            type:"error",
                            buttons: false,
                            timer:700
                        });
                    } else {
                        console.log(response);
                        $('input[id="name"]').val(response.name);
                        $('textarea[id="description"]').val(response.description);                        
                        $('input[id="id"]').val(response.id);                        
                    }
                }
            });
        });

        $('.update').on('click',function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });
            var id = $('input[id="id"]').val();
            var name = $('input[id="name"]').val();
            var description = $('textarea[id="description"]').val();
            var role_id = {{ Auth::user()->role_id }};

            $.ajax({
                url: "{{ route('app.menus.edit') }}",
                type: 'POST',
                dataType: "JSON",
                data: {
                    "id": id,
                    "name": name,
                    "role_id": role_id,
                    "description": description,
                },
                success: function (response){
                    if (response.success) {
                        $('#table-menu').DataTable().ajax.reload();   
                        window.location.href='';     
                        Swal.fire({
                            title:"Sukses!",
                            text:response.success,
                            type:"success",
                            buttons: false,
                            timer:700
                        });
                        $('#edit').modal('hide');
                        $('input[id="title"]').val('');
                        $('textarea[id="description"]').val('');
                        $('input[id="id"]').val('');
                    }else{
                        Swal.fire({
                            title:"Error!",
                            text:response.errors.title[0],
                            type:"error",
                            buttons: false,
                            timer:700
                        });
                    }
                }
            });
        });

        $('[data-toggle="select2"]').select2();
        $("#nestable_list_1").nestable().on("click", function (t) { $('#nestable_list_1').attr('clickable',false) });

        @if(Session::has('success'))
            Swal.fire({
                title:"Sukses!",
                text:"{{ session('success') }}",
                type:"success",
                timer:700
            })
        @endif

        @if (count($errors) > 0)
            $('#tambah-submenu').modal('show');
        @endif

        // hapus submenu
        $(".hapus-submenu[data-id]").on('click',function(e){
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
                        url: "{{ route('app.submenus.delete') }}",
                        type: 'DELETE',
                        dataType: "JSON",
                        data: {
                            "id": id,
                        },
                        success: function (response){
                            if (response.success) {   
                                window.location.href='';                            
                                Swal.fire({
                                    title:"Sukses!",
                                    text:response.success,
                                    type:"success",
                                    buttons: false,
                                    timer:1000,
                                });
                            }else{
                                Swal.fire({
                                    title:"Sukses!",
                                    text:response.error,
                                    type:"error",
                                    timer:1000,
                                });
                            }
                        }
                    });
                }else if (result.dismiss === swal.DismissReason.cancel) {}

            })
        });
        // hapus itemmenu
        $(".hapus-itemmenu[data-id]").on('click',function(e){
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
                        url: "{{ route('app.itemmenu.delete') }}",
                        type: 'DELETE',
                        dataType: "JSON",
                        data: {
                            "id": id,
                        },
                        success: function (response){
                            if (response.success) {   
                                window.location.href='';                            
                                Swal.fire({
                                    title:"Sukses!",
                                    text:response.success,
                                    type:"success",
                                    buttons: false,
                                    timer:1000,
                                });
                            }else{
                                Swal.fire({
                                    title:"Sukses!",
                                    text:response.error,
                                    type:"error",
                                    timer:1000,
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