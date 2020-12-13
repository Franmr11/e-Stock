@extends('layouts.header')


@section('imports')
    <link href="{{ asset('css/formularios.css') }}" rel="stylesheet">
    <link href="{{ asset('css/productosForm.css') }}" rel="stylesheet">
    <script src="{{ asset('js/productosForm.js') }}"></script>

@endsection
@section('titulo')
    <a href="{{ url('/home') }}">Home</a> / 
    <a href="{{ url('/empresas/'.$producto->id_empresa.'/inicio') }}">Empresa</a> / 
    <a href="{{ url('/empresas/'.$producto->id_empresa.'/productos') }}">Productos</a> / 
{{ $accion }}

@endsection
@section('content')

    @if(Auth::user())
        <div class="campos">
            @if ($accion == 'Crear')
                <form method="POST" action="{{ action('ProductosController@productoCreate') }}" id="new_producto">
            @elseif ($accion == 'Editar')
                <form method="POST" action="{{ action('ProductosController@productoEdit') }}" id="new_producto">
            @endif
                {{ csrf_field() }}
                <input type="hidden" name="producto_empresa" value="{{ $producto->id_empresa }}">
                <input type="hidden" name="producto_id" value="{{ $producto->id }}">

                <div class="row">
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <div><label class="titulo" for="producto_nombre">Nombre:</label></div>
                        <input type="text" class="form-control" name="producto_nombre" placeholder="Introduce el nombre." value="{{ $producto->nombre }}" required>
                    </div>
                    <div class="col-lg-2 col-md-2 col-xs-12">
                        <div>
                            <label class="titulo" for="producto_stock">Stock:</label>
                        </div>
                        <input type="number" class="form-control" name="producto_stock" min="0" value="{{ $producto->stock }}">
                    </div>
                    @if ($accion == 'Editar')
                            <div class="col-lg-6 col-md-6 col-xs-8 col text-right">
                                <div>
                                    <label class="titulo" for="producto_stock">Mostrar aviso de stock bajo:</label>
                                </div>
                            <?php $checked = '' ?>
                            @if ($producto->ignorar == 0)
                                <?php $checked = 'checked' ?>
                            @endif
                                <input class="prueba" type="checkbox" {{ $checked }} data-toggle="toggle" data-onstyle="info">
                            </div>
                    @endif 
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <div>
                            <label class="titulo" for="producto_proveedor">Proveedor:</label>
                        </div>
                        @if(isset($proveedores))
                            <select name="producto_proveedor" class="form-control" form="new_producto">
                                <option value="">Sin proveedor</option>
                                @foreach ($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}" {{ $proveedor->id == $producto->id_proveedor ? "selected" : "" }}>{{ $proveedor->nombre }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <div>
                            <label class="titulo" for="producto_categorias">Categorias:</label>
                        </div>
                            @if(isset($categorias))
                                <select name="producto_categoria" class="form-control" form="new_producto">
                                    <option value="">Sin categoria</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" {{ $categoria->id == $producto->id_categoria ? "selected" : "" }}>{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            @endif
                    </div>
                </div>

                <div id="descripcion">
                    <div>
                        <label class="titulo" for="producto_descripcion">Descripción:</label>
                    </div>
                    <textarea rows="4" cols="50" name="producto_descripcion" class="form-control" form="new_producto" placeholder="Añade una descripción al producto">{{ $producto->descripcion }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">{{ $accion }} Producto.</button>
            </form>
        </div>
    @else
        <script> window.location = "/e-stock/public/"; </script>
    @endif

@endsection
