<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
            name='viewport' />

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.ico') }}">

        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

        <!-- CSS Files -->
        <link href="{{ asset('assets/css/light-bootstrap-dashboard.css?v=2.0.0') }}" rel="stylesheet" />
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body>
        <div id="app" class="wrapper">
            @yield('sidebar')
            <div class="main-panel">
                <!-- Navbar -->
                @yield('navbar')
                <!-- End Navbar -->
                <div class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <!-- Scripts -->
        <!--   Core JS Files   -->
        <script src="{{ asset('js/app.js') }}"></script>
        <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
        <script src="{{ asset('assets/js/plugins/bootstrap-switch.js') }}"></script>
        <!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
        <script src="{{ asset('assets/js/light-bootstrap-dashboard.js?v=2.0.0') }}" type="text/javascript"></script>
        <script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script>
            $(document).ready( function () {
                $('#dataTable').DataTable();
            });
        </script>
        @yield('pageScript')

    </body>

</html>
