@extends('layouts.header')

@include('layouts.menuLateral')
@section('imports')
    <link href="{{ asset('css/empresasIni.css') }}" rel="stylesheet">
    <script src="{{ asset('js/empresasIni.js') }}"></script>

@endsection
@section('titulo')

    <a href="{{ url('/home') }}">Home</a> / Empresas

@endsection
@section('content')
    @if (isset($productos))
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
                        <td>
                            <a href="{{ url('/empresas/'.$empresa->id.'/productos/edit/'.$producto->id) }}">
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
    @else
        <div>No hay ningun producto aun.</div>
    @endif
<div class="alert alert-warning fade in">
    <button class="close" data-dismiss="alert">
        ×
    </button>
    <i class="fa-fw fa fa-warning"></i>
    <strong>¡Ciudado!</strong> Estos productos tienen un stock bajo.
</div>
    
@endsection
