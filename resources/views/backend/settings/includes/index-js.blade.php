@push('js-scripts')
<!-- Tost-->
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js">
</script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js">
</script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

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
                process: '{{ route("app.settings.tmp-img-user") }}',
                revert: '{{ route("app.settings.tmp-delete-user") }}',
                headers:{
                    'X-CSRF-TOKEN':'{{ csrf_token() }}'
                }
            }
        });

        const img_fav = document.querySelector('input[type="file"][name=img_fav]');
        FilePond.create(img_fav, {
            allowFileSizeValidation:true,
            maxFileSize:1000000,
            acceptedFileTypes: ['image/png','image/jpg','image/jpeg', 'image/svg'],
            fileValidateTypeDetectType: (source, type) =>
                new Promise((resolve, reject) => {
                    resolve(type);
                }),
        }).setOptions({
            server:{
                process: '{{ route("app.settings.tmp-img-fav") }}',
                revert: '{{ route("app.settings.tmp-delete-fav") }}',
                headers:{
                    'X-CSRF-TOKEN':'{{ csrf_token() }}'
                }
            }
        });

        const img_lg = document.querySelector('input[type="file"][name=img_lg]');
        FilePond.create(img_lg, {
            allowFileSizeValidation:true,
            maxFileSize:1000000,
            acceptedFileTypes: ['image/png','image/jpg','image/jpeg', 'image/svg'],
            fileValidateTypeDetectType: (source, type) =>
                new Promise((resolve, reject) => {
                    resolve(type);
                }),
        }).setOptions({
            server:{
                process: '{{ route("app.settings.tmp-img-lg") }}',
                revert: '{{ route("app.settings.tmp-delete-lg") }}',
                headers:{
                    'X-CSRF-TOKEN':'{{ csrf_token() }}'
                }
            }
        });
        const img_sm = document.querySelector('input[type="file"][name=img_sm]');
        FilePond.create(img_sm, {
            allowFileSizeValidation:true,
            maxFileSize:1000000,
            acceptedFileTypes: ['image/png','image/jpg','image/jpeg', 'image/svg'],
            fileValidateTypeDetectType: (source, type) =>
                new Promise((resolve, reject) => {
                    resolve(type);
                }),
        }).setOptions({
            server:{
                process: '{{ route("app.settings.tmp-img-sm") }}',
                revert: '{{ route("app.settings.tmp-delete-sm") }}',
                headers:{
                    'X-CSRF-TOKEN':'{{ csrf_token() }}'
                }
            }
        });
        const img_nota = document.querySelector('input[type="file"][name=img_nota]');
        FilePond.create(img_nota, {
            allowFileSizeValidation:true,
            maxFileSize:1000000,
            acceptedFileTypes: ['image/png','image/jpg','image/jpeg', 'image/svg'],
            fileValidateTypeDetectType: (source, type) =>
                new Promise((resolve, reject) => {
                    resolve(type);
                }),
        }).setOptions({
            server:{
                process: '{{ route("app.settings.tmp-img-nota") }}',
                revert: '{{ route("app.settings.tmp-delete-nota") }}',
                headers:{
                    'X-CSRF-TOKEN':'{{ csrf_token() }}'
                }
            }
        });
        
    })
    $(document).ready(function(){
        $.fn.editable.defaults.mode = 'inline';
        $.fn.editableform.buttons='<button type="submit" class="btn btn-primary editable-submit btn-sm waves-effect waves-light"><i class="mdi mdi-check"></i></button><button type="button" class="btn btn-danger editable-cancel btn-sm waves-effect"><i class="mdi mdi-close"></i></button>';
        $(".inline-username").editable({
            url: "{{ route('app.settings.update') }}",
            type:"text",
            pk:1,
            name:"name",
            inputclass:"form-control-sm form-control"
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
                timer:700
            })
        @endif
    });
</script>
@endpush