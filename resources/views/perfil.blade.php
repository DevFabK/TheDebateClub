@extends('layouts.app')

@section('title', 'Perfil')

@section('styles')
    <link href="{{ asset('css/estilos-perfil.css') }}" rel="stylesheet" />
@endsection

@section('content')

    <div class="contenido-perfil">
        <div class="info-personal" data-label="Temas en los que has participado: ">
            <img src="{{ $user->foto_perfil }}" alt="Foto de perfil" class="foto-perfil">

            <div class="informacion">
                <div class="nombre-y-puntos">
                    <h3>{{ $user->nombre }}</h3>
                    <div class="puntos">
                        <span>Puntos de debate: {{ $user->puntos_de_debate }}</span>
                    </div>
                </div>
                <p>{{ $user->email }}</p>
            </div>
        </div>
        <div class="participaciones">
            <div class="participacion" data-label="Temas en los que has participado: ">
                <ul class="participacion-list">
                    @foreach ($temasParticipados as $tema)
                        <li>{{ $tema->titulo }}</li>
                        <!-- HACER QUE ESTOS SEAN UN LINK, CREAR UN TEMACONTROLLER (NO SIRVE EL BUSCADORTEMACONTROLLER) -->
                    @endforeach
                </ul>
            </div>
            <div class="mejor-argumento" data-label="Tu mejor argumento">
                {{ $mejorArgumento->contenido }}
            </div>
        </div>
        <button onclick="window.history.back()" class="atras-perfil">Volver</button>
    </div>

@endsection
