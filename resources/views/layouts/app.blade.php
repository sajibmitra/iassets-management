<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Iassets Mamn') }}</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ elixir('css/all.css')}}" >
    <!-- Scripts -->
    <script src="{{ elixir('js/all.js')}}"></script>

    <style type="text/css">
        .navbar-brand>img {
            max-height: 100%;
            height: 100%;
            width: auto;
            margin: 0 auto;


            /* probably not needed anymore, but doesn't hurt */
            -o-object-fit: contain;
            object-fit: contain;

        }
    </style>
    <!-- Scripts -->
    <script>
        window.Laravel =<?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}" >
                        {{ config('app.name', 'Iassets Mamn') }}
                    </a>

                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <!-- Left Side Of Navbar -->
                    @if(Auth::guest())

                    @else
                        <ul class="nav navbar-nav navbar-left">
                            <li><a href="{{url('iassets')}}"> Assets </a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-left">
                            <li><a href="{{url('iusers')}}"> Users </a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-left">
                            <li><a href="{{url('ivendors')}}"> Vendors </a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-left">
                            <li><a href="{{url('iworkstations')}}"> Workstations </a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-left">
                            <li><a href="{{url('iresponses')}}"> Responses </a></li>
                        </ul>

                    @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    @yield('footer')
</body>
</html>
