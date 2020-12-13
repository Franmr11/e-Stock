@extends('layouts.header')

    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@section('titulo')
    Home
@endsection
@section('content')
    
    <div id="bienvenida">Bienvenido a su panel de empresas, <b>{{ Auth::user()->nombre }}.</b></div>
    @foreach ($empresas as $empresa)
    <div class="empresa">
        <a href="{{ url('empresas/'.$empresa->id.'/inicio') }}">
            <div class="empresa_contenido">
                <img class="empresa_logo" src="{{ asset('img/logos-empresas/'. $empresa->logo) }}">
                <span class="empresa_nombre">{{ $empresa->nombre }}</span>
            </div>
        </a>
    </div>
    @endforeach
    <div class="empresa">
        <a href="{{ url('/empresas/new') }}">
            <div class="empresa_contenido">
                <img class="empresa_logo" src="{{ asset('img/mas.png') }}">
                <span class="empresa_nombre">Añadir</span>
            </div>
        </a>
    </div>

@endsection
