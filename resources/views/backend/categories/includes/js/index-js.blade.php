@push('js-scripts')
<script src="{{ asset('assets') }}/libs/jquery-tabledit/jquery.tabledit.min.js"></script>
<script src="{{ asset('assets') }}/libs/x-editable/bootstrap-editable/js/bootstrap-editable.min.js"></script>
@endpush
@push('page-scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });
    
    $(document).ready(function(){
        var tableCategory = $('#table-category').DataTable({
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
                url: '{{ route("app.categories.load-data") }}',
                cache:false,
            },
            columns: [
                { data: 'id', name: 'id',className:'text-hide' },
                { "data": null,"sortable": false, className:'text-center',render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } },
                { data: 'title', name: 'title' },
                { data: 'slug', name: 'slug' },
                { data: 'description', name: 'description' },
                { data: 'is_active', name: 'is_active', className:'text-center', render:function($data){
                    if ($data == true) {
                        return '<div class="badge badge-success">Active</div>';
                    }else{
                        return '<div class="badge badge-secondary">Non-Active</div>';
                    }
                } },         
                { data: 'created_at', name: 'created_at',className:'text-center' },                
                
            ],          
            search: {
                "regex": true
            }
        });

        //inline edit table
        tableCategory.on('draw.dt', function() {
            $('#table-category').Tabledit({
                url: '{{ route("app.categories.update") }}',
                dataType: 'json',
                cache: false,
                columns: {
                    identifier: [0, "id"],
                    editable: [
                        [2, "title"],
                        [4, "description"],
                    ]
                },
                buttons: {
                    edit: {
                        class: "btn btn-success",
                        html: '<span class="mdi mdi-pencil"></span>',
                        action: "edit"
                    },
                    delete: {
                        class: "btn btn-danger",
                        html: '<span class="mdi mdi-trash-can"></span>',
                        action: "delete"
                    }
                },
                inputClass: "form-control",
                saveButton: 1,
                deleteButton: 1,
                autoFocus: !1,
                restoreButton: false,
                onSuccess: function(data) {
                    $('#table-category').DataTable().ajax.reload();
                },
                onError: function() {
                    Swal.fire({
                        title: "Error!",
                        text: "An error occurred. Please try again.",
                        type: "error",
                    });
                }
            });
        });

        $('#addFormCategory').on('submit',function(e){
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('app.categories.create') }}",
                method: 'POST',
                dataType: "JSON",
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                success: function (response){
                    if (response.success) {
                        $('#table-category').DataTable().ajax.reload();
                        $('#add-category').modal('hide');
                        $("#addFormCategory")[0].reset();
                        Swal.fire({
                            title:"Sukses!",
                            text:response.success,
                            type:"success",
                            timer:700
                        }).then(() => { 
                            $("#addFormCategory")[0].reset();
                        });
                    }else{
                        let errorMessage = response.error && response.error.title ? response.error.title[0] : "Something went wrong!";
                        Swal.fire({
                            title:"Warning!",
                            html: '<span class="text-danger">' + errorMessage + '</span>',
                            type:"warning",
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: "Error!",
                        text: "An error occurred. Please try again.",
                        type: "error",
                    });
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
    });

</script>
@endpush