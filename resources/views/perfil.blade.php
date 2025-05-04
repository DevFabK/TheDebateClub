@extends('layouts.app')

@section('perfil', 'Perfil')

@section('styles')
<link href="{{ asset('css/estilos-perfil.css') }}" rel="stylesheet" />
@endsection

@section('content')

    <div class="contenido-perfil">
        <div class="info-personal">
            <img src="{{ $user->foto_perfil }}" alt="Foto de perfil" class="foto-perfil">
            <div class="informacion">
                <h3>{{ $user->nombre }}</h3>
                <p>{{ $user->email }}</p>
            </div>
            <div class="puntos">
                <span>Puntos de debate: {{ $user->puntos_de_debate }}</span>
            </div>
        </div>
        <div class="participaciones">
            <div class="participacion" data-label="Has participado en">
                <ul class="participacion-list">
                    @foreach( $temasParticipados as $tema)
                    <li>{{ $tema->titulo }}</li> <!-- HACER QUE ESTOS SEAN UN LINK, CREAR UN TEMACONTROLLER (NO SIRVE EL BUSCADORTEMACONTROLLER) -->
                    @endforeach
                </ul>
            </div>
            <div class="mejor-argumento" data-label="Mejor argumento">
                    {{ $mejorArgumento->contenido }}
            </div>
        </div>
    </div>

@endsection