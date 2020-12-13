@extends('layouts.header')
@include('layouts.menuLateral')

@section('imports')
    <script src="{{ asset('js/proveedoresIni.js') }}"></script>
    <link href="{{ asset('css/proveedoresIni.css') }}" rel="stylesheet">
@endsection

@section('titulo')
<a href="{{ url('/home') }}">Home</a> / <a href="{{ url('/empresas/'.$empresa->id.'/inicio') }}">Empresa</a> / Proveedores
@endsection

@section('content')
    @if (isset($proveedores))
        <div class="contenedor_tabla">
            <table id="dt-filter-select" class="table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th class="th-sm">Nombre</th>
                    <th class="th-sm">Email</th>
                    <th class="th-sm">Telefono</th>
                    <th class="th-sm">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proveedores as $proveedor)
                        <tr>
                            <td>{{ $proveedor->nombre }}</td>
                            <td>{{ $proveedor->email }}</td>
                            <td>{{ $proveedor->telefono }}</td>
                            <td>
                                <a href="{{ url('/empresas/'.$empresa->id.'/proveedores/edit/'.$proveedor->id) }}">
                                    <button class="acciones_botones btn btn-info">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                </a>
                                <a href="{{ url('/empresas/'.$empresa->id.'/proveedores/delete/'.$proveedor->id) }}">
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
        <div>No hay ningun proveedor aun.</div>
    @endif
    <div class="contenedor_add">
        <a href="{{ url('/empresas/'.$empresa->id.'/proveedores/new') }}" class="enlace_add">
            <i class="fas fa-plus"></i>
        </a>
    </div>
@endsection
