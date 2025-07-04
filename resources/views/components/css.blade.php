<!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{  asset('dist/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('dist/vendor/fonts/iconify-icons.css') }}" />

    <!-- Core CSS -->
    <!-- build:css dist/vendor/css/theme.css  -->
 <link rel="stylesheet" href="{{ asset('datatables.min.css') }}">
    <link rel="stylesheet" href="{{asset('dist/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{asset('dist/css/demo.css') }}" />

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="{{ asset('dist/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('dist/sweetalert2.min.css') }}">

    <!-- endbuild -->

    <link rel="stylesheet" href="dist/vendor/libs/apex-charts/apex-charts.css" />
    {{-- <link rel="stylesheet" href='@vite(["resources/css/app.css"])'> --}}
    @vite(["resources/css/app.css","resources/js/app.js"])
    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('dist/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="{{ asset('dist/js/config.js') }}"></script>
    <script src="{{ asset('dist/sweetalert2.js') }}"></script>

    <!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">

<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
 
