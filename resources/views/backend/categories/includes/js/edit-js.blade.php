@push('page-scripts')
<script>
    $(document).ready(function(){
        @if(Session::has('success'))
            Swal.fire({
                title:"Sukses!",
                text:"{{ session('success') }}",
                type:"success",
                timer:700
            })
        @endif
    });

</script>
@endpush