<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
          body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
          }
          .containerMe {
            width: 100%;
            padding-right: 2px;
            padding-left: 3px;
            margin-right: auto;
            margin-left: auto;
          }
         

   
    </style>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.names', 'E_WASTE MANAGMENT') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="text-center" >
      <h1 >E-Waste Management System</h1>
      <p>Republic of Bangladesh</p>
    </div>

    <div id="app"  >
        <nav class="navbar navbar-expand-md navbar-dark bg-secondary navbar-laravel">
            <div class="containerMe">
               
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                   <ul class="navbar-nav mr-auto">
                         <a class="navbar-brand" href="{{ url('/')}}">
                                 {{ config('app.names', 'E-WASTE') }}
                               </a>
                          <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                          <li  class="nav-item"><a class="nav-link" href="{{ url('/gmap') }}" >Map</a></li>

                          <li class="nav-item dropdown d-md-down-none">
                              <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-bell"></i>
                                <span class="badge badge-pill badge-danger">5</span>
                              </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                            <div class="dropdown-header text-center">
                              <strong>You have 5 notifications</strong>
                            </div>
                            <!--<a class="dropdown-item" href="#">
                            <i class="icon-user-follow text-success"></i> New user registered</a>
                            <a class="dropdown-item" href="#">
                            <i class="icon-user-unfollow text-danger"></i> User deleted</a>
                            <a class="dropdown-item" href="#">
                            <i class="icon-chart text-info"></i> Sales report is ready</a>
                            <a class="dropdown-item" href="#">
                            <i class="icon-basket-loaded text-primary"></i> New client</a>
                            <a class="dropdown-item" href="#">
                            <i class="icon-speedometer text-warning"></i> Server overloaded</a>
                            <div class="dropdown-header text-center">-->
                           
                    </ul> 

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item center">
                                <a class="nav-link" href="{{ route('user.userlogin') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.userregister') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                     <a class="dropdown-item" href="{{ route('user.userprofile') }}">
                                        {{ __('profile') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <a class="dropdown-item" href="#">
                                        {{ __('Setting') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">

            @yield('content')

        </main>
    </div>
</body>
</html>
