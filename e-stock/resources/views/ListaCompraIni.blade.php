@extends('layouts.header')
@include('layouts.menuLateral')

@section('imports')
    <script src="{{ asset('js/listaCompraIni.js') }}"></script>
    <link href="{{ asset('css/listaCompraIni.css') }}" rel="stylesheet">
@endsection

@section('titulo')
    <a href="{{ url('/home') }}">Home</a> / <a href="{{ url('/empresas/'.$empresa->id.'/inicio') }}">Empresa</a> / Lista de la Compra
@endsection

@section('content')
@if (isset($lista_compra))
        <table id="dt-filter-select" class="table" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">Producto</th>
                    <th class="th-sm">Nom. Proveedor</th>
                    <th class="th-sm">Tel. Proveedor</th>
                    <th class="th-sm">Email Proveedor</th>
                    <th class="th-sm">Cantidad</th>
                    <th class="th-sm">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lista_compra as $compras)
                    <tr>
                        <td>{{ $compras->nombre_prod }}</td>
                        <td>{{ $compras->proveedor_nombre }}</td>
                        @if ($compras->proveedor_telefono == '-')
                            <td>-</td>
                        @else
                            <td><a href="tel:{{ $compras->proveedor_telefono }}">{{ $compras->proveedor_telefono }}</a></td>
                        @endif
                        @if ($compras->proveedor_email == '-')
                            <td>-</td>
                        @else
                            <td><a href="mailto:{{ $compras->proveedor_email }}">{{ $compras->proveedor_email }}</a></td>
                        @endif
                        <td>
                            <input class="cantidad" id="{{ $compras->id }}" type="number" value="{{ $compras->cantidad }}" min="0" width="50%"></input>
                        </td>
                        <td>
                            <a href="{{ url('/empresas/'.$empresa->id.'/listaCompra/delete/'.$compras->id) }}">
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
        <div>No hay ningun producto en la lista aun.</div>
    @endif
@endsection
