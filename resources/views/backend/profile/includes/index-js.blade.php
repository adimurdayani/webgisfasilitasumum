@push('js-scripts')
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js">
</script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js">
</script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
@endpush

@push('page-scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });

    $(document).ready(function(){        
        FilePond.registerPlugin(FilePondPluginFileValidateSize);
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        FilePond.registerPlugin(FilePondPluginImagePreview);

        const img_user = document.querySelector('input[type="file"][name=img_user]');
        FilePond.create(img_user, {
            allowFileSizeValidation:true,
            maxFileSize:1000000,
            acceptedFileTypes: ['image/png','image/jpg','image/jpeg', 'image/svg'],
            fileValidateTypeDetectType: (source, type) =>
                new Promise((resolve, reject) => {
                    resolve(type);
                }),
        }).setOptions({
            server:{
                process: '{{ route("app.profile.tmpupload-img") }}',
                revert: '{{ route("app.profile.tmpdelete-img") }}',
                headers:{
                    'X-CSRF-TOKEN':'{{ csrf_token() }}'
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
</script>
@endpush