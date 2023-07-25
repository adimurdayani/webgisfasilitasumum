@push('page-scripts-front')
<script>
    $(document).ready(function(){
        $('.views-add[data-idpost]').on('click',function(e){
            var id = $(this).data('idpost');
            console.log(id);
            $.ajax({
                url: "{{ route('home.news.add-view') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                data: {
                    "id": id,
                }
            });
        });
    });
</script>
@endpush