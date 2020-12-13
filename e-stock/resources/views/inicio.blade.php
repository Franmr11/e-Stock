<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>E-stock - Inicio</title>

        <!-- Styles -->
        <link rel="icon" href="{{ asset('img/fav-icon.png') }}">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap-toggle2.min.css') }}" rel="stylesheet">
        <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.js') }}"></script>

    <!-- Usado para el boton off/on en productos --> 
        <script src="{{ asset('js/bootstrap-toggle2.min.js') }}"></script>
        <script src="{{ asset('js/inicio.js') }}"></script>
        <link href="{{ asset('css/inicio.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    </head>
    <body>
        <img id="fondo" src="{{ asset('img/inicio/bg1.png') }}">
        <div id="parallax">
            <div id="p-header">
                <div id="logo">
                    <img src="{{ asset('img/logo.png') }}">
                </div>
                <div id="sesion">
                    @if (Auth::guest())
                        <a id="login" href="{{ url('/login') }}">Login</a>
                        <a id="registro" href="{{ url('/register') }}">Registrarse</a>
                        @else
                                <a href="{{ url('/home') }}">
                                    {{ Auth::user()->usuario }} <span class="caret"></span>
                                </a>
                        @endif
                    
                </div>
            </div>
            <div id="p-body">
                <div id="subtitulo">Organiza tu tienda online.</div>
            </div>
            <div id="p-footer">
                <div id="arrow">
                    <a href="#servicios" id="ancla">
                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </a>    
                </div>
            </div>
        </div>
        <div id="servicios">
            <div id="servicios_texto">
                <span>
                    Nuestros servicios
                </span>
            </div>
            <div id="first">
                <img src="{{ asset('img/inicio/icon1.png') }}" alt="icono-casa" id="icon1" heigth="99px" width="99px">
                <span>Controla tu inventario desde casa.</span>
            </div>
            <div id="second">
                <img src="{{ asset('img/inicio/icon2.png') }}" alt="icono-casa" id="icon2">
                <span>Organiza todos tus productos desde una misma aplicación</span>
            </div>
            <div id="third">
                <img src="{{ asset('img/inicio/icon3.png') }}" alt="icono-casa" id="icon3" heigth="99px" width="99px">
                <span>Realiza pedidos a tus proveedores cómodamente.</span>
            </div>
        </div>
        <div id="triangulos">
            <img src="{{ asset('img/inicio/triangles.png') }}" id="img_triangulos">
        </div>
        <div id="formulario">
            <div id="contacto_texto">
                <span>
                    Contactanos
                </span>
            </div>
            <div id="form-body">
                <form method="POST" action="{{ action('IniController@mandarEmail') }}" enctype="multipart/form-data"  id="form_contacto">
                    {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-xs-12">
                                <input type="text" class="form-control campos" name="nombre" placeholder="Nombre." id="nombre" required>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-12">
                                <input type="text" class="form-control campos" name="apellidos" placeholder="Apellidos" required>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-12">
                                <input type="text" class="form-control campos" name="telefono" placeholder="Teléfono" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" title="Debe ser un numero de teléfono válido" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <input type="email" class="form-control campos" name="email" placeholder="Correo electrónico" required>
                            </div>
                        </div>
                        <div id="descripcion">
                            <textarea rows="4" cols="50" name="mensaje" class="form-control campos" form="form_contacto" placeholder="Mensaje"></textarea>
                        </div>
                    <button type="submit" class="btn btn-crema">Enviar mensaje.</button>
                </form>
            </div>
        </div>
    </body>
</html>
