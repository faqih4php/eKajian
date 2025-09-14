<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class=" layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr" data-skin="default"
    data-assets-path="/assets/" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>
        @yield('title')
    </title>
    @stack('css')
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon/favicon.ico">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">

    <link rel="stylesheet" href="/assets/vendor/fonts/iconify-icons.css">

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->


    <link rel="stylesheet" href="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="/assets/vendor/css/core.css">
    <link rel="stylesheet" href="/assets/css/demo.css">

    <link rel="stylesheet" href="/assets/vendor/libs/spinkit/spinkit.css">

    <link href="/assets/datatables/datatables.bootstrap4.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/vendor/libs/%40form-validation/form-validation.css">


    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="/assets/vendor/js/template-customizer.js"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="/assets/js/config.js"></script>

</head>

<body>

    @include('components.alert')
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">

            <!-- Menu -->
            @include('layouts.sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">

                <!-- Navbar -->
                @include('layouts.navbar')
                <!-- / Navbar -->


                <!-- Content wrapper -->
                @yield('content')
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>

    </div>
    @yield('loader')
    <!-- / Layout wrapper -->







    <!-- Core JS -->
    <!-- build:js assets/vendor/js/theme.js  -->


    <script src="/assets/vendor/libs/jquery/jquery.js"></script>

    <script src="/assets/vendor/libs/popper/popper.js"></script>
    <script src="/assets/vendor/js/bootstrap.js"></script>

    <script src="/assets/vendor/js/menu.js"></script>

    <!-- endbuild -->


    <script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <!-- Vendors JS -->
    {{-- <script src="/assets/vendor/libs/apex-charts/apexcharts.js"></script> --}}
    <!-- Main JS -->

    <script src="/assets/js/main.js"></script>

    <!-- Vendors JS -->

    <script src="/assets/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>

    <!-- Page JS -->
    {{-- <script src="/assets/js/app-calendar-events.js"></script> --}}
    {{-- <script src="/assets/js/app-calendar.js"></script> --}}
    {{-- <script src="/assets/js/dashboards-analytics.js"></script> --}}
    @stack('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form Delete
            const deleteForms = document.querySelectorAll('.form-delete');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); // cegah submit otomatis

                    Swal.fire({
                        ...getSwalOptions('warning', 'Hapus Data?',
                            'Data ini akan dihapus permanen.'),
                        showCancelButton: true,
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // Form Reject
            const rejectForms = document.querySelectorAll('.form-reject');

            rejectForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); // cegah submit otomatis

                    Swal.fire({
                        ...getSwalOptions('error', 'Reject Request Kajian?',
                            'Data ini akan ditolak.'),
                        showCancelButton: true,
                        confirmButtonText: 'Ya, tolak!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>

<!-- beautify ignore:end -->
