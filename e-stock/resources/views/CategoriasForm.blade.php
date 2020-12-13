@extends('layouts.header')

@section('imports')
    <link href="{{ asset('css/formularios.css') }}" rel="stylesheet">
    <link href="{{ asset('css/categoriasForm.css') }}" rel="stylesheet">
    <script src="{{ asset('js/categoriasForm.js') }}"></script>
@endsection
@section('titulo')

    <a href="{{ url('/home') }}">Home</a> / 
    <a href="{{ url('/empresas/'.$categoria->id_empresa.'/inicio') }}">Empresa</a> / 
    <a href="{{ url('/empresas/'.$categoria->id_empresa.'/categorias') }}">Categorias</a> / 
    {{ $accion }}

@endsection
@section('content')

    @if(Auth::user())
        <div class="campos">
            @if ($accion == 'Crear')
                <form method="POST" action="{{ action('CategoriasController@categoriaCreate') }}" id="new_categoria">
            @elseif ($accion == 'Editar')
                <form method="POST" action="{{ action('CategoriasController@categoriaEdit') }}" id="new_categoria">
            @endif
                {{ csrf_field() }}
                <input type="hidden" name="categoria_id" value="{{ $categoria->id }}">
                <input type="hidden" name="categoria_empresa" value="{{ $categoria->id_empresa }}">

                <div class="row">
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <div><label class="titulo" for="categoria_nombre">Nombre:</label></div>
                        <input type="text" class="form-control" name="categoria_nombre" placeholder="Introduce el nombre." value="{{ $categoria->nombre }}" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ $accion }} categoria.</button>
            </form>
        </div>
    @else
        <script> window.location = "/e-stock/public/"; </script>
    @endif

@endsection
