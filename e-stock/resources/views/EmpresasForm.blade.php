@extends('layouts.header')
            @if ($accion == 'Editar')
                @include('layouts.menuLateral')
            @endif

@section('imports')
    <link href="{{ asset('css/formularios.css') }}" rel="stylesheet">
    <link href="{{ asset('css/empresasForm.css') }}" rel="stylesheet">
    <script src="{{ asset('js/empresasForm.js') }}"></script>

@endsection
@section('titulo')

            @if ($accion == 'Crear')
                <a href="{{ url('/home') }}">Home</a> / Nueva Empresa
            @elseif ($accion == 'Editar')
                <a href="{{ url('/home') }}">Home</a> / 
                <a href="{{ url('/empresas/'.$empresa->id.'/inicio') }}">Empresa</a> / Opciones
            @endif

@endsection
@section('content')

    @if(Auth::user())
        <div class="campos">
            @if ($accion == 'Crear')
                <form method="POST" action="{{ action('EmpresasController@empresaCreate') }}" enctype="multipart/form-data">
            @elseif ($accion == 'Editar')
                <form method="POST" action="{{ action('EmpresasController@empresaEdit') }}" enctype="multipart/form-data">
            @endif
                {{ csrf_field() }}
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
                @if ($accion == 'Editar')
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-xs-12">
                            <div><label class="titulo" for="usuario_nombre">Nombre del titular:</label></div>
                            <input type="text" class="form-control" name="usuario_nombre" value="{{ $user->nombre }}" readonly>
                        </div>
                        <div class="col-lg-4 col-md-4 col-xs-12">
                            <div><label class="titulo" for="usuario_apellidos">Apelllidos del titular:</label></div>
                            <input type="text" class="form-control" name="usuario_apellidos" placeholder="nombre." value="{{ $user->apellidos }}" readonly>
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <div><label class="titulo" for="empresa_nombre">Nombre:</label></div>
                        <input type="text" class="form-control" name="empresa_nombre" placeholder="Introduce el nombre." value="{{ $empresa->nombre }}" required>
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <div><label class="titulo" for="empresa_CIF">CIF:</label></div>
                        <input type="text" class="form-control" name="empresa_CIF" placeholder="CIF" value="{{ $empresa->cif }}" pattern="^[a-zA-Z]{1}\d{7}[a-zA-Z0-9]{1}$" title="El formato correcto es una letra y 8 numeros" required>
                    </div>
                    <div class="col-lg-2 col-md-2 col-xs-12">
                        <div><label class="titulo" for="empresa_telefono">telefono:</label></div>
                        <input type="text" class="form-control" name="empresa_telefono" placeholder="Teléfono" value="{{ $empresa->telefono }}" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" title="Debe ser un numero de teléfono válido" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <div><label class="titulo" for="empresa_direccion">direccion:</label></div>
                        <input type="text" class="form-control" name="empresa_direccion" placeholder="Introduce la dirección." value="{{ $empresa->direccion }}">
                    </div>
                    <div class="col-lg-2 col-md-2 col-xs-12">
                        <div><label class="titulo" for="empresa_pais">País:</label></div>
                        <input type="text" class="form-control" name="empresa_pais" placeholder="País" value="{{ $empresa->pais }}">
                    </div>
                    <div class="col-lg-3 col-md-3 col-xs-12">
                        <div><label class="titulo" for="empresa_ciudad">Ciudad:</label></div>
                        <input type="text" class="form-control" name="empresa_ciudad" placeholder="Introduce la ciudad." value="{{ $empresa->ciudad }}">
                    </div>
                    <div class="col-lg-2 col-md-2 col-xs-12">
                        <div><label class="titulo" for="cod_postal">codigo postal:</label></div>
                        <input type="text" class="form-control" name="cod_postal" placeholder="Cod. Postal." value="{{ $empresa->cod_postal }}" pattern="[0-9]{5}$" title="Debe se un codigo postal valido" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        @if ($accion == 'Editar')
                            <img id="uploadPreview" width="75" height="75" src="{{ asset('img/logos-empresas/'. $empresa->logo) }}" />
                        @endif    
                        <input id="uploadImage" name="logo" type="file" onchange="previewImage;"/>
                    </div>    
                </div>
                <button type="submit" class="btn btn-primary">{{ $accion }} Empresa.</button>
                @if ($accion == 'Editar')
                <a href="{{ url('/empresas/'.$empresa->id.'/delete') }}" class="btn btn-danger" onclick="return confirm('¿Está seguro de querer eliminar la empresa? Se eliminaran todos sus productos de forma recursiva.')">Eliminar empresa.</a>
                @endif  
            </form>
        </div>
    @else
        <script> window.location = "/e-stock/public/"; </script>
    @endif

@endsection
