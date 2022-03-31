<!doctype html>
<html lang="en">


<head>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8" />
    <title>DLPS App | Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    @livewireStyles
</head>

<body>

    @yield('content')

    <!-- JAVASCRIPT -->
    <script src="/assets/libs/jquery/jquery.min.js"></script>
    <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="/assets/libs/node-waves/waves.min.js"></script>

    <!-- App js -->
    <script src="/assets/js/app.js"></script>

    @livewireScripts
</body>

</html>
