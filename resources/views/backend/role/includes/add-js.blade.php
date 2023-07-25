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