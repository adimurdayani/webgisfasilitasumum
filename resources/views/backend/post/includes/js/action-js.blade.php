@push('js-scripts')
<script src="{{ asset('assets') }}/filepond/filepond-plugin-file-validate-size.js">
</script>
<script src="{{ asset('assets') }}/filepond/filepond-plugin-file-validate-type.js">
</script>
<script src="{{ asset('assets') }}/filepond/filepond-plugin-image-preview.js"></script>
<script src="{{ asset('assets') }}/filepond/filepond-plugin-image-transform.js"></script>

<script src="{{ asset('assets') }}/filepond/filepond.js"></script>

<script src="{{ asset('assets/') }}/libs/select2/js/select2.min.js"></script>
<script src="{{ asset('assets/') }}/libs/flatpickr/flatpickr.min.js"></script>
<script src="{{ asset('assets/') }}/libs/selectize/js/standalone/selectize.min.js"></script>

<script src="{{ asset('assets/ckeditor') }}/ckeditor.js"></script>
@endpush

@push('page-scripts')
<script>
    $(document).ready(function(){
        FilePond.registerPlugin(FilePondPluginFileValidateSize);
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.registerPlugin(FilePondPluginImageTransform);

        FilePond.create(document.querySelector('input[name="image"]'));
        FilePond.setOptions({
            allowFileSizeValidation:true,
            maxFileSize:2000000,
            imageValidateSizeMaxWidth:600000,
            acceptedFileTypes: ['image/png','image/jpg','image/jpeg', 'image/svg'],      
            imageResizeTargetWidth: 600,
            imageCropAspectRatio: 1,
            imageTransformVariants: {
                thumb_medium_: (transforms) => {
                    transforms.resize = {
                        size: {
                            width: 370,
                            height: 250,
                        },
                    };
                    return transforms;
                }
            },
            fileValidateTypeDetectType: (source, type) =>
            new Promise((resolve, reject) => {
                resolve(type);
            }),
            server:{
                process: '{{ route("app.posts.tmp-upload-img") }}',
                revert: '{{ route("app.posts.tmp-delete-img") }}',
                headers:{
                    'X-CSRF-TOKEN':'{{ csrf_token() }}'
                }
            }
        });

        $('[data-toggle="select2"]').select2();
        
        $('[data-toggle="flatpicker"]').flatpickr({altInput:!0,enableTime:!0,altFormat:"Y-m-d H:i:s",dateFormat:"Y-m-d H:i:s"});
        $("#selectize-tags").selectize({
            persist:!1,
            createOnBlur:!0,
            create:function(input, callback){
                $.ajax({
                    url: '{{ route("app.tags.create") }}',
                    type: 'POST',
                    dataType:'JSON',
                    headers:{
                        'X-CSRF-TOKEN':'{{ csrf_token() }}'
                    },
                    data:{
                        'name':input
                    },
                    success: function (result) {
                        if (result) {
                            callback({ value: result.name, text: input });
                        }
                    }
                });
            }
        });

        $('select[name="categorie_id"]').on('change',function(){
            var id = $(this).val();
            $.ajax({
                url: "{{ route('app.posts.sub-category') }}",
                type: 'GET',
                dataType: "JSON",
                data: {
                    "id": id,
                },
                success: function (data){
                    if(data){
                        $('select[name="subcategorie_id"]').empty();
                        $.each(data, function(key, subcategory){
                            $('select[name="subcategorie_id"]').append('<option value="'+ subcategory.id +'">' + subcategory.title+ '</option>');
                        });
                    }else{
                        $('select[name="subcategorie_id"]').empty();
                    }
                }
            });
        });

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
            })
        @endif
    });

</script>
@endpush