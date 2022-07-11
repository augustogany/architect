<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('theme/dist/img/logo.png') }}" type="image/x-icon">

    <title>@yield('title','CADBENI') | Architec</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ionicons.min.css') }}" rel="stylesheet" type="text/css">
    
    <!-- Theme pace -->
    <link rel="stylesheet" href="{{asset('theme/dist/css/pace/pace-theme-minimal.css')}}">
    @stack('styles')
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <img src="{{asset('theme/dist/img/logo.png')}}" class="img-circle elevation-3" style="width: 50px; height: 50px">
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                @include('layouts.partials.navbar')

            </div>
        </nav>
        @include('sweetalert::alert')
        <main class="py-4">
            @yield('content')
        </main>
       {{--  Btn top
        <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
          <i class="fas fa-chevron-up"></i>
        </a> --}}
    </div>
    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}"></script>
    
    @stack('script')
    
    <!-- Pace -->
    

    <script src="{{ asset('theme/dist/js/pace.min.js') }}"></script>
    
</body>
</html>
