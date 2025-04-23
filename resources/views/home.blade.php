@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

<div class="contenedor">
    <div class="debate-del-dia">
        <h2 class="titulo">Temas de debates</h2>

        <div class="temas">
            @foreach($temasArray as $tema)
            <p>{{ $tema->titulo }}</p>
            @endforeach
        </div>
    </div>
</div>

@endsection