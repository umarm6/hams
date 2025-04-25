<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css','resources/css/style.css', 'resources/js/app.js'])
        {!! ToastMagic::styles() !!}
      </head>

    <!-- Page Heading -->
    <body class="bg-gray-100">

    <!-- ===== Main Content Start ===== -->

    <!-- start navbar -->
    @include('layouts.topNavbar')
    <!-- end navbar -->


    <!-- strat wrapper -->
    <div class="h-screen flex flex-row flex-wrap">

        <!-- start sidebar -->
        @include('layouts.sidebar')
        <!-- end sidbar -->

        <!-- strat content -->

        @yield('content')
        <!-- end content -->

    </div>
    <!-- end wrapper -->

    <main>
      yield
    </main>
    <!-- ===== Main Content End ===== -->
    </body>
    <!-- script -->
    {!! ToastMagic::scripts() !!}

</html>
