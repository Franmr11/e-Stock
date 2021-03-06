@extends('layouts.header')
@include('layouts.menuLateral')

@section('imports')
    <script src="{{ asset('js/categoriasIni.js') }}"></script>
    <link href="{{ asset('css/categoriasIni.css') }}" rel="stylesheet">
@endsection

@section('titulo')
    <a href="{{ url('/home') }}">Home</a> / <a href="{{ url('/empresas/'.$empresa->id.'/inicio') }}">Empresa</a> / Categorias
@endsection

@section('content')
    
    @if (isset($categorias))
    <div class="contenedor_tabla">
        <table id="dt-filter-select" class="table" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">Nombre</th>
                    <th class="th-sm">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->nombre }}</td>
                        <td>
                            <a href="{{ url('/empresas/'.$empresa->id.'/categorias/edit/'.$categoria->id) }}">
                                <button class="acciones_botones btn btn-info" id="edit">
                                    <i class="fa fa-pencil"></i>
                                </button>
                            </a>
                            <a href="{{ url('/empresas/'.$empresa->id.'/categorias/delete/'.$categoria->id) }}">
                                <button class="acciones_botones btn btn-danger" id="delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <div>No hay ningun categoria aun.</div>
    @endif
    <div class="contenedor_add">
        <a href="{{ url('/empresas/'.$empresa->id.'/categorias/new') }}" class="enlace_add">
            <i class="fas fa-plus"></i>
        </a>
    </div>
@endsection
