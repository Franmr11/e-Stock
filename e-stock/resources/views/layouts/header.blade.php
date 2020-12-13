<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>E-stock - Home</title>



    <!-- Styles -->
    <link rel="icon" href="{{ asset('img/fav-icon.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">

    <link href="{{ asset('css/esqueleto.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/bootstrap-toggle2.min.css') }}" rel="stylesheet">

    <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.js') }}"></script>

    <link href="{{ asset('MDB-Free/css/addons/datatables2.min.css') }}" rel="stylesheet">
    
    <!-- MDBootstrap Datatables  -->
    <script type="text/javascript" src="{{ asset('MDB-Free/js/addons/datatables2.min.js') }}" defer></script>

    <!-- Usado para el boton off/on en productos --> 
    <script src="{{ asset('js/bootstrap-toggle2.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

    @yield('imports')
    <script>
        $('a#conexion').click( function(){
            alert('Función aun no disponible.');
        });
    </script>

    <script src="{{ asset('js/general.js') }}"></script>

</head>

<body>

<div class="loading"></div>

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



                    <!-- Branding Image -->

                    <a class="navbar-brand inicio" href="{{ url('/') }}">

                        <img id="logo" src="{{ asset('img/logo.png') }}">

                    </a>

                </div>



                <div class="collapse navbar-collapse" id="app-navbar-collapse">

                    <!-- Left Side Of Navbar -->

                    <ul class="nav navbar-nav">

                        &nbsp;

                    </ul>



                    <!-- Right Side Of Navbar -->

                    <ul class="nav navbar-nav navbar-right">

                        <!-- Authentication Links -->

                        @if (Auth::guest())

                            <li><a href="{{ route('login') }}">Login</a></li>

                            <li><a href="{{ route('register') }}">Registrarse</a></li>

                        @else

                            <li class="dropdown">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">

                                    {{ Auth::user()->usuario }} <span class="caret"></span>

                                </a>



                                <ul class="dropdown-menu" role="menu">

                                    <li><a href="{{ url('/') }}"> Inicio</a></li>
                                    <li><a href="{{ url('/usuario/edit') }}"> Perfil</a></li>

                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            Desconectarse
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

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

    </div>

    <div id="body_empresas">

        <div class="container_body">

            <div class="container_titulo">

                <b>@yield('titulo')</b>

            </div>

            <div class="container_empresas">

                @yield('content')

            </div>



        </div>

    </div>

    



    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>

