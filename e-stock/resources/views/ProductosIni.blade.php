@extends('layouts.header')
@include('layouts.menuLateral')

@section('imports')
    <script src="{{ asset('js/productosIni.js') }}"></script>
    <link href="{{ asset('css/productosIni.css') }}" rel="stylesheet">
@endsection

@section('titulo')
    <a href="{{ url('/home') }}">Home</a> / <a href="{{ url('/empresas/'.$empresa->id.'/inicio') }}">Empresa</a> / Productos
@endsection

@section('content')
    @if (isset($productos))
        <div class="contenedor_tabla">
            <table id="dt-filter-select" class="table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">Nombre</th>
                        <th class="th-sm">Descripción</th>
                        <th class="th-sm">Proveedor</th>
                        <th class="th-sm">Categoría</th>
                        <th class="th-sm">Stock</th>
                        <th class="th-sm">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->descripcion }}</td>
                            <td>{{ $producto->proveedor_nombre }}</td>
                            <td>{{ $producto->categoria_nombre }}</td>
                            <td>{{ $producto->stock }}</td>
                            <td><a href="{{ url('/empresas/'.$empresa->id.'/productos/edit/'.$producto->id) }}">
                                    <button class="acciones_botones btn btn-info">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                </a>
                                <a href="{{ url('/empresas/'.$empresa->id.'/listaCompra/new&prod='.$producto->id) }}">
                                    <button class="acciones_botones btn btn-warning">
                                        <i class="fa fa-list"></i>
                                    </button>
                                </a>
                                <a href="{{ url('/empresas/'.$empresa->id.'/productos/delete/'.$producto->id) }}">
                                    <button class="acciones_botones btn btn-danger">
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
        <div>No hay ningun producto aun.</div>
    @endif
    <div class="contenedor_add">
        <a href="{{ url('/empresas/'.$empresa->id.'/productos/new') }}" class="enlace_add">
            <i class="fas fa-plus"></i>
        </a>
    </div>
@endsection
