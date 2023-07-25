<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon"
        href="{{ setting('1')->img_fav != null ? asset('storage/img').'/'.setting('1')->img_fav : asset('assets/images/not_found.jpg') }}">

    <!-- App css -->
    <link href="{{ asset('assets') }}/css/bootstrap-material.min.css" rel="stylesheet" type="text/css"
        id="bs-default-stylesheet" />
    <link href="{{ asset('assets') }}/css/app-material.min.css" rel="stylesheet" type="text/css"
        id="app-default-stylesheet" />

    <link href="{{ asset('assets') }}/css/bootstrap-material-dark.min.css" rel="stylesheet" type="text/css"
        id="bs-dark-stylesheet" disabled />
    <link href="{{ asset('assets') }}/css/app-material-dark.min.css" rel="stylesheet" type="text/css"
        id="app-dark-stylesheet" disabled />

    <!-- icons -->
    <link href="{{ asset('assets') }}/css/icons.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="authentication-bg authentication-bg-pattern">

    @yield('content')

    <footer class="footer footer-alt">
        2022 - <script>
            document.write(new Date().getFullYear())
        </script> &copy; {{ setting('1')->app_name != null ?
        setting('1')->app_name : 'Isi Nama Perusahaan' }}
    </footer>

    <!-- Vendor js -->
    <script src="{{ asset('assets') }}/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="{{ asset('assets') }}/js/app.min.js"></script>

    {{-- google reCAPTCHA --}}
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</body>

</html>