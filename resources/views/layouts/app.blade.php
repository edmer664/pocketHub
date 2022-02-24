<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PocketHub') }}</title>
    <link rel="icon" href="{{ asset('assets/img/logo-new-round.ico')}}"></link>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"
        integrity="sha256-MsxKR7Nw4ngHKmRAJJhy5oHvodmSYAQgwDqWMdqIXXA=" crossorigin="anonymous">
    <link href="{{asset('assets/vendors/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200&display=swap" rel="stylesheet">
    <link href="{{asset('assets/css/sb-admin-2.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/toaster/bootstrap-toaster.min.css')}}" />


</head>

<body id="page-top">
    <div id="wrapper">
        @include('layouts.sidebar')

        <div class="d-flex flex-column w-100">
            <div id="content">
                @auth
                @include('layouts.navbar')
                @endauth
                <main class="container-fluid">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    
    <script src="{{asset('assets/vendors/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendors/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('assets/js/sb-admin-2.min.js')}}"></script>
    <script src="{{asset('assets/js/toaster/bootstrap-toaster.min.js')}}"></script>
    <script src="{{asset('assets/js/user.min.js')}}"></script>
    <script src="{{asset('assets/js/post.min.js')}}"></script>
    <script src="{{asset('assets/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('assets/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('assets/js/demo/chart-pie-demo.js')}}"></script>
    <script src="https://kit.fontawesome.com/1e11a39cdc.js" crossorigin="anonymous"></script>
    
</body>

</html>
