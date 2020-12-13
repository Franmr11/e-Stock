@extends('layouts.header')

@section('imports')
    <link href="{{ asset('css/formularios.css') }}" rel="stylesheet">
    <link href="{{ asset('css/proveedoresForm.css') }}" rel="stylesheet">
    <script src="{{ asset('js/proveedoresForm.js') }}"></script>
@endsection
@section('titulo')

    <a href="{{ url('/home') }}">Home</a> / 
    <a href="{{ url('/empresas/'.$proveedor->id_empresa.'/inicio') }}"> Empresa</a> / 
    <a href="{{ url('/empresas/'.$proveedor->id_empresa.'/proveedores') }}"> Proveedores</a> / 
    {{ $accion }}

@endsection
@section('content')

    @if(Auth::user())
        <div class="campos">
            @if ($accion == 'Crear')
                <form method="POST" action="{{ action('ProveedoresController@proveedorCreate') }}" id="new_proveedor">
            @elseif ($accion == 'Editar')
                <form method="POST" action="{{ action('ProveedoresController@proveedorEdit') }}" id="new_proveedor">
            @endif
                {{ csrf_field() }}
                <input type="hidden" name="proveedor_empresa" value="{{ $proveedor->id_empresa }}">
                <input type="hidden" name="proveedor_id" value="{{ $proveedor->id }}">

                <div class="row">
                <div class="col-lg-4 col-md-4 col-xs-12">
                        <div><label class="titulo" for="proveedor_nombre">Nombre:</label></div>
                        <input type="text" class="form-control" name="proveedor_nombre" placeholder="Introduce el nombre." value="{{ $proveedor->nombre }}" required>
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <div><label class="titulo" for="proveedor_email">Email:</label></div>
                        <input type="email" class="form-control" name="proveedor_email" placeholder="Introduce el email." value="{{ $proveedor->email }}">
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <div><label class="titulo" for="proveedor_telefono">Telefono:</label></div>
                        <input type="text" class="form-control" name="proveedor_telefono" placeholder="Introduce el telefono." value="{{ $proveedor->telefono }}" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" title="Debe ser un numero de teléfono válido" >
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ $accion }} proveedor.</button>
            </form>
        </div>
    @else
        <script> window.location = "/e-stock/public/"; </script>
    @endif

@endsection
