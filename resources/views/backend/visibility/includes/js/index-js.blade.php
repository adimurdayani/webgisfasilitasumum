@push('js-scripts')
<!-- Tost-->
<script src="{{ asset('assets') }}/libs/jquery-tabledit/jquery.tabledit.min.js"></script>
<script src="{{ asset('assets') }}/libs/x-editable/bootstrap-editable/js/bootstrap-editable.min.js"></script>
<script src="{{ asset('assets') }}/libs/jquery-toast-plugin/jquery.toast.min.js"></script>
@endpush

@push('page-scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });
    
    $(document).ready(function(){
        $('#table-visibility').DataTable({
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
                url: '{{ route("app.visibilities.load-data") }}',
                cache:false,
            },
            columns: [
                { data: 'id', name: 'id',className:'text-hide'},
                { "data": null,"sortable": false, className:'text-center',render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } },
                { data: 'title', name: 'title' },
                { data: 'description', name: 'description' },     
                { data: 'created_at', name: 'created_at',className:'text-center' },                
                { data: 'id', name: 'id', className:'text-center', render:function(data,row,value){
                    return '<div class="btn-group">'+
                                    '<button type="button" class="btn btn-sm btn-danger hapus-data" data-id="'+value.id+'"><i class="mdi mdi-trash-can"></i></button>'+
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
        $('#table-visibility').on('draw.dt', function() {
            $("#table-visibility").Tabledit({
                url: '{{ route("app.visibilities.edit") }}',
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
                        $('#table-visibility').DataTable().ajax.reload();
                    }else{
                        Swal.fire({
                            title:"Gagal!",
                            text:data.error,
                            type:"error",
                            timer:1000
                        })
                        $('#table-visibility').DataTable().ajax.reload();
                    }
                },
                columns: {
                    identifier: [0, "id"],
                    editable: [
                        [2, "title"],
                        [3, "description"],
                    ]
                }
            });
        });

        $("#table-visibility").on('click','.hapus-data[data-id]',function(e){
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
                        url: "{{ route('app.visibilities.destroy') }}",
                        type: 'DELETE',
                        dataType: "JSON",
                        data: {
                            "id": id,
                        },
                        success: function (response){
                            if (response.success) {
                                $('#table-visibility').DataTable().ajax.reload();
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
                                    timer:700
                                });
                            }
                        }
                    });
                }else if (result.dismiss === swal.DismissReason.cancel) {}

            })
        });

        $('.simpan').on('click',function(){
            var title = $('input[id="title"]').val();
            var description = $('textarea[id="description"]').val();

            if (title == "") {
                Swal.fire({
                    title:"Error!",
                    text:"Field title is required!",
                    type:"error",
                    timer:700
                });
            } else {
                $.ajax({
                    url: "{{ route('app.visibilities.create') }}",
                    type: 'POST',
                    dataType: "JSON",
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    },
                    data: {
                        "title": title,
                        "description": description,
                    },
                    success: function (response){
                        $('#table-visibility').DataTable().ajax.reload();
                        $('#tambah').modal('hide');
                        $('input[id="title"]').val('');
                        $('textarea[id="description"]').val('');
                        Swal.fire({
                            title:"Sukses!",
                            text:response.success,
                            type:"success",
                            timer:700
                        });
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