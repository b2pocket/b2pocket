<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
   <link rel="icon" href="../resources/views/layouts/icon.ico" type="image/x-icon">
    <title>B2ME</title>

    <!-- Scripts -->
    {{-- @guest --}}
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    {{--     <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script> --}}
    {{-- @endguest --}}
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    {{-- @guest --}}
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    

      <link rel="stylesheet" href="{{ asset("assets/stylesheets/jquery.dataTables.min.css") }}" />
    <link rel="stylesheet" href="{{ asset("assets/stylesheets/bootstrap.min.css") }}" />
    
    {{-- <link rel="stylesheet" href="{{ asset("assets/stylesheets/dataTables.bootstrap.min.css") }}" /> --}}
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/scroller/1.5.1/css/scroller.bootstrap4.min.css" /> --}}

    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/sc-1.5.0/datatables.min.css"/> --}}
 

     {{-- @endguest --}}

    <!-- Portal CSS - MILOS -->
    {{-- @auth --}}
    <link rel="stylesheet" href="{{ asset("assets/stylesheets/style4.css") }}" />

     <link rel="stylesheet" href="{{ asset("assets/stylesheets/styleMilos.css") }}" />
     <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.dataTables.min.css" />
     
   
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css">


    {{-- @endauth --}}

</head>
<body>
    <div id="app">
     
        {{-- Moje skripte --}}


    <script src="{{ asset("assets/scripts/jquery-3.3.1.min.js") }}" type="text/javascript"></script>
    {{-- <script src="{{ asset("assets/scripts/jquery-ui.min.js") }}" type="text/javascript"></script> --}}
    <script src="{{ asset("assets/scripts/jquery.dataTables.min.js") }}" type="text/javascript"></script>

   

    <script src="{{ asset("assets/scripts/bootstrap.min.js") }}" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script>
    
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/sc-1.5.0/datatables.min.js"></script> --}}

    {{-- <script src="{{ asset("assets/scripts/frontend.js") }}" type="text/javascript"></script> --}}

    
    

    
 




        {{-- !!!!!! --}}

        @guest
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- {{ config('app.name') }} --}}
                    B2B PORTAL
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                             {{--    <li class="nav-item"> ISKLUCENO STANDARDNO REGISTROVANJE
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a> 
                                </li> --}}
                            @endif
                        
                        
                        @endguest
                        @guest 
                    </ul>
                </div>
            </div>
        </nav>
         @endguest
        
            @yield('body')
     
    </div>

    <footer class="footer fixed-bottom">
        <div class="container " style="background-color: #E9E9E9;">
            <span class="text-muted">Copyright @2019 | Designed With by B2ME</span>
        </div>
    </footer>
</body>
</html>
