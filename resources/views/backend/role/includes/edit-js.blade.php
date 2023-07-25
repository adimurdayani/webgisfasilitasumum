@push('page-scripts')
<script>
    $(document).ready(function(){

        $('#select-all').click(function(e){
            if (this.checked) {
                $(':checkbox').each(function(){
                    this.checked = true;
                });
            }else{
                $(':checkbox').each(function(){
                    this.checked = false;
                });
            }
        })

        $('select[name="menu_id"]').on('change',function(){
            var id = $(this).val();
            $.ajax({
                url: "{{ route('app.roles.submenu') }}",
                type: 'GET',
                dataType: "JSON",
                data: {
                    "id": id,
                },
                success: function (data){
                    if(data){
                        $('select[name="submenu_id"]').empty();
                        $('select[name="submenu_id"]').append('<option>-- Select Sub Menu --</option>');
                        $.each(data, function(key, submenu){
                            $('select[name="submenu_id"]').append('<option value="'+ submenu.id +'">' + submenu.title+ '</option>');
                        });
                    }else{
                        $('select[name="submenu_id"]').empty();
                    }
                }
            });
        });

        $('select[name="submenu_id"]').on('change',function(){
            var id = $(this).val();
            $.ajax({
                url: "{{ route('app.roles.menuitem') }}",
                type: 'GET',
                dataType: "JSON",
                data: {
                    "id": id,
                },
                success: function (data){
                    if(data){
                        $('select[name="menuitem_id"]').empty();
                        $.each(data, function(key, menuitem){
                            $('select[name="menuitem_id"]').append('<option value="'+ menuitem.id +'">' + menuitem.title+ '</option>');
                        });
                    }else{
                        $('select[name="menuitem_id"]').empty();
                    }
                }
            });
        });

        $('[data-toggle="select2"]').select2();

        @if(Session::has('success'))
            Swal.fire({
                title:"Sukses!",
                text:"{{ session('success') }}",
                type:"success",
                timer:700
            })
        @endif
        @if(Session::has('error'))
            Swal.fire({
                title:"Gagal!",
                text:"{{ session('error') }}",
                type:"error",
                timer:700
            })
        @endif
    });

</script>
@endpush