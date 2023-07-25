@push('page-scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });
    
    $(document).ready(function(){
        $('input[type="checkbox"][id=customSwitch1]').on('click', function(){
            $('input[type="checkbox"][id=customSwitch1]').attr("checked", false);
            var mode = $(this).val();
            $.ajax({
                url: "{{ route('app.theme.update-mode-light',SiteHelper::themes()->id) }}",
                type: 'POST',
                dataType: "JSON",
                success: function (response){
                    window.location.reload();
                    Swal.fire({
                        title:"Sukses!",
                        text:response.success,
                        type:"success",
                        timer:700
                    });
                }
            });
        });

        $('input[type="checkbox"][id=customSwitch2]').on('click', function(){
            $('input[type="checkbox"][id=customSwitch2]').attr("checked", false);
            var mode = $(this).val();
            $.ajax({
                url: "{{ route('app.theme.update-mode-dark',SiteHelper::themes()->id) }}",
                type: 'POST',
                dataType: "JSON",
                success: function (response){
                    window.location.reload();
                    Swal.fire({
                        title:"Sukses!",
                        text:response.success,
                        type:"success",
                        timer:700
                    });
                }
            });
        });

        $('input[type="checkbox"][id=customSwitch3]').on('click', function(){
            $('input[type="checkbox"][id=customSwitch3]').attr("checked", false);
            var mode = $(this).val();
            $.ajax({
                url: "{{ route('app.theme.update-width-fluid',SiteHelper::themes()->id) }}",
                type: 'POST',
                dataType: "JSON",
                success: function (response){
                    window.location.reload();
                    Swal.fire({
                        title:"Sukses!",
                        text:response.success,
                        type:"success",
                        timer:700
                    });
                }
            });
        });

        $('input[type="checkbox"][id=customSwitch4]').on('click', function(){
            $('input[type="checkbox"][id=customSwitch4]').attr("checked", false);
            var mode = $(this).val();
            $.ajax({
                url: "{{ route('app.theme.update-width-boxed',SiteHelper::themes()->id) }}",
                type: 'POST',
                dataType: "JSON",
                success: function (response){
                    window.location.reload();
                    Swal.fire({
                        title:"Sukses!",
                        text:response.success,
                        type:"success",
                        timer:700
                    });
                }
            });
        });

        $('input[type="checkbox"][id=customSwitch5]').on('click', function(){
            $('input[type="checkbox"][id=customSwitch5]').attr("checked", false);
            var mode = $(this).val();
            $.ajax({
                url: "{{ route('app.theme.update-menu-position-fixed',SiteHelper::themes()->id) }}",
                type: 'POST',
                dataType: "JSON",
                success: function (response){
                    window.location.reload();
                    Swal.fire({
                        title:"Sukses!",
                        text:response.success,
                        type:"success",
                        timer:700
                    });
                }
            });
        });

        $('input[type="checkbox"][id=customSwitch6]').on('click', function(){
            $('input[type="checkbox"][id=customSwitch6]').attr("checked", false);
            var mode = $(this).val();
            $.ajax({
                url: "{{ route('app.theme.update-menu-position-scrollable',SiteHelper::themes()->id) }}",
                type: 'POST',
                dataType: "JSON",
                success: function (response){
                    window.location.reload();
                    Swal.fire({
                        title:"Sukses!",
                        text:response.success,
                        type:"success",
                        timer:700
                    });
                }
            });
        });

        $('input[type="checkbox"][id=customSwitch7]').on('click', function(){
            $('input[type="checkbox"][id=customSwitch7]').attr("checked", false);
            var mode = $(this).val();
            $.ajax({
                url: "{{ route('app.theme.update-sidebarcolor-light',SiteHelper::themes()->id) }}",
                type: 'POST',
                dataType: "JSON",
                success: function (response){
                    window.location.reload();
                    Swal.fire({
                        title:"Sukses!",
                        text:response.success,
                        type:"success",
                        timer:700
                    });
                }
            });
        });
        $('input[type="checkbox"][id=customSwitch8]').on('click', function(){
            $('input[type="checkbox"][id=customSwitch8]').attr("checked", false);
            var mode = $(this).val();
            $.ajax({
                url: "{{ route('app.theme.update-sidebarcolor-dark',SiteHelper::themes()->id) }}",
                type: 'POST',
                dataType: "JSON",
                success: function (response){
                    window.location.reload();
                    Swal.fire({
                        title:"Sukses!",
                        text:response.success,
                        type:"success",
                        timer:700
                    });
                }
            });
        });
        $('input[type="checkbox"][id=customSwitch9]').on('click', function(){
            $('input[type="checkbox"][id=customSwitch9]').attr("checked", false);
            var mode = $(this).val();
            $.ajax({
                url: "{{ route('app.theme.update-sidebarcolor-brand',SiteHelper::themes()->id) }}",
                type: 'POST',
                dataType: "JSON",
                success: function (response){
                    window.location.reload();
                    Swal.fire({
                        title:"Sukses!",
                        text:response.success,
                        type:"success",
                        timer:700
                    });
                }
            });
        });
        $('input[type="checkbox"][id=customSwitch10]').on('click', function(){
            $('input[type="checkbox"][id=customSwitch10]').attr("checked", false);
            var mode = $(this).val();
            $.ajax({
                url: "{{ route('app.theme.update-sidebarcolor-gradient',SiteHelper::themes()->id) }}",
                type: 'POST',
                dataType: "JSON",
                success: function (response){
                    window.location.reload();
                    Swal.fire({
                        title:"Sukses!",
                        text:response.success,
                        type:"success",
                        timer:700
                    });
                }
            });
        });

        $('input[type="checkbox"][id=customSwitch11]').on('click', function(){
            $('input[type="checkbox"][id=customSwitch11]').attr("checked", false);
            var sidebar_size = $(this).val();
            $.ajax({
                url: "{{ route('app.theme.update-sidebar-size',SiteHelper::themes()->id) }}",
                type: 'POST',
                dataType: "JSON",
                data:{
                    'sidebar_size':sidebar_size
                },
                success: function (response){
                    window.location.reload();
                    Swal.fire({
                        title:"Sukses!",
                        text:response.success,
                        type:"success",
                        timer:700
                    });
                }
            });
        });

        $('input[type="checkbox"][id=customSwitch12]').on('click', function(){
            $('input[type="checkbox"][id=customSwitch12]').attr("checked", false);
            var sidebar_size = $(this).val();
            $.ajax({
                url: "{{ route('app.theme.update-sidebar-size',SiteHelper::themes()->id) }}",
                type: 'POST',
                dataType: "JSON",
                data:{
                    'sidebar_size':sidebar_size
                },
                success: function (response){
                    window.location.reload();
                    Swal.fire({
                        title:"Sukses!",
                        text:response.success,
                        type:"success",
                        timer:700
                    });
                }
            });
        });

        $('input[type="checkbox"][id=customSwitch13]').on('click', function(){
            $('input[type="checkbox"][id=customSwitch13]').attr("checked", false);
            var sidebar_size = $(this).val();
            $.ajax({
                url: "{{ route('app.theme.update-sidebar-size',SiteHelper::themes()->id) }}",
                type: 'POST',
                dataType: "JSON",
                data:{
                    'sidebar_size':sidebar_size
                },
                success: function (response){
                    window.location.reload();
                    Swal.fire({
                        title:"Sukses!",
                        text:response.success,
                        type:"success",
                        timer:700
                    });
                }
            });
        });

        $('input[type="checkbox"][id=customSwitch14]').on('click', function(){
            $('input[type="checkbox"][id=customSwitch14]').attr("checked", false);
            var sidebar_showuser = $(this).val();
            $.ajax({
                url: "{{ route('app.theme.update-sidebar-showuser',SiteHelper::themes()->id) }}",
                type: 'POST',
                dataType: "JSON",
                data:{
                    'sidebar_showuser':sidebar_showuser
                },
                success: function (response){
                    window.location.reload();
                    Swal.fire({
                        title:"Sukses!",
                        text:response.success,
                        type:"success",
                        timer:700
                    });
                }
            });
        });

        $('input[type="checkbox"][id=customSwitch15]').on('click', function(){
            $('input[type="checkbox"][id=customSwitch15]').attr("checked", false);
            var topbar_color = $(this).val();
            $.ajax({
                url: "{{ route('app.theme.update-topbar-color',SiteHelper::themes()->id) }}",
                type: 'POST',
                dataType: "JSON",
                data:{
                    'topbar_color':topbar_color
                },
                success: function (response){
                    window.location.reload();
                    Swal.fire({
                        title:"Sukses!",
                        text:response.success,
                        type:"success",
                        timer:700
                    });
                }
            });
        });

        $('input[type="checkbox"][id=customSwitch16]').on('click', function(){
            $('input[type="checkbox"][id=customSwitch16]').attr("checked", false);
            var topbar_color = $(this).val();
            $.ajax({
                url: "{{ route('app.theme.update-topbar-color',SiteHelper::themes()->id) }}",
                type: 'POST',
                dataType: "JSON",
                data:{
                    'topbar_color':topbar_color
                },
                success: function (response){
                    window.location.reload();
                    Swal.fire({
                        title:"Sukses!",
                        text:response.success,
                        type:"success",
                        timer:700
                    });
                }
            });
        });
    });
</script>
@endpush