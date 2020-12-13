@extends('layouts.header')

@section('imports')
    <link href="{{ asset('css/usuariosForm.css') }}" rel="stylesheet">
    <script src="{{ asset('js/usuariosForm.js') }}"></script>
@endsection

@section('titulo')
    <a href="{{ url('/home') }}">Home</a> / usuario
@endsection

@section('content')

    @if(Auth::user())
        <div class="campos">
                <form method="POST" action="{{ action('UserController@actualizarUsuario') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-xs-12">
                            <div><label class="titulo" for="usuario_usuario">usuario:</label></div>
                            <input type="text" class="form-control" name="usuario_usuario" placeholder="Introduce el usuario." value="{{ $usuario->usuario }}" required>
                        </div>
                        <div class="col-lg-3 col-md-3 col-xs-12">
                            <div><label class="titulo" for="usuario_nombre">nombre:</label></div>
                            <input type="text" class="form-control" name="usuario_nombre" placeholder="nombre" value="{{ $usuario->nombre }}" required>
                        </div>
                        <div class="col-lg-4 col-md-4 col-xs-12">
                            <div><label class="titulo" for="usuario_apellidos">apellidos:</label></div>
                            <input type="text" class="form-control" name="usuario_apellidos" placeholder="apellidos" value="{{ $usuario->apellidos }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-xs-12">
                            <div><label class="titulo" for="usuario_telefono">Telefono:</label></div>
                            <input type="text" class="form-control" name="usuario_telefono" placeholder="Introduce la dirección." pattern="[0-9]{3}[0-9]{3}[0-9]{3}" title="Debe ser un numero de teléfono válido" value="{{ $usuario->telefono }}" required>
                        </div>
                        <div class="col-lg-4 col-md-4 col-xs-12">
                            <div><label class="titulo" for="usuario_email">Email:</label></div>
                            <input type="email" class="form-control" name="usuario_email" placeholder="País" value="{{ $usuario->email }}">
                        </div>
                        <div class="col-lg-4 col-md-4 col-xs-12">
                            <div><label class="titulo" for="usuario_password">password:</label></div>
                            <input type="password" class="form-control" name="usuario_password" placeholder="Introduce la password." value="{{ $usuario->password }}" required>
                        </div>
                    </div>
                <button type="submit" class="btn btn-primary">Guardar cambios.</button>
                <a href="{{ url('/usuarios/delete') }}" class="btn btn-danger" onclick="return confirm('¿Está seguro de querer eliminar el usuario? Se eliminaran todas sus usuarios.')">Eliminar usuario.</a>
            </form>
        </div>
    @else
        <script> window.location = "/e-stock/public/"; </script>
    @endif

@endsection
