<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class=" layout-wide  customizer-hide" dir="ltr" data-skin="default"
    data-assets-path="/assets/" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon/favicon.ico">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link
        href="/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="/assets/vendor/fonts/iconify-icons.css">

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->

    <link rel="stylesheet" href="/assets/vendor/css/core.css">
    <link rel="stylesheet" href="/assets/css/demo.css">

    <!-- Vendor -->
    <link rel="stylesheet" href="/assets/vendor/libs/%40form-validation/form-validation.css">

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="/assets/vendor/css/pages/page-auth.css">

    <!-- Helpers -->
    <script src="/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="/assets/vendor/js/template-customizer.js"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="/assets/js/config.js"></script>
    @stack('css')

</head>

<body>

    <!-- Content -->

    @yield('content')

    <!-- / Content -->







    <!-- Core JS -->
    <!-- build:js assets/vendor/js/theme.js  -->


    <script src="/assets/vendor/libs/jquery/jquery.js"></script>

    <script src="/assets/vendor/libs/popper/popper.js"></script>
    <script src="/assets/vendor/js/bootstrap.js"></script>
    <script src="/assets/vendor/libs/%40algolia/autocomplete-js.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="/assets/vendor/libs/%40form-validation/popular.js"></script>
    <script src="/assets/vendor/libs/%40form-validation/bootstrap5.js"></script>
    <script src="/assets/vendor/libs/%40form-validation/auto-focus.js"></script>

    <!-- Main JS -->

    <script src="/assets/js/main.js"></script>


    <!-- Page JS -->
    <script src="/assets/js/pages-auth.js"></script>

</body>

</html>
@stack('name')
<!-- beautify ignore:end -->
