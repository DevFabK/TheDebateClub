@extends('layouts.app')

@section('title', 'Perfil')

@section('styles')
    <link href="{{ asset('css/estilos-perfil.css') }}" rel="stylesheet" />
@endsection

@section('content')

    <div class="contenido-perfil">
        <div class="info-personal" data-label="Temas en los que has participado: ">

            @php
                $src = $user->foto_perfil
                    ? asset('storage/' . $user->foto_perfil)
                    : asset('storage/fotos_perfil/default.jpg');
            @endphp

            <img src="{{ $src }}" alt="Foto de perfil" class="foto-perfil">

            <div class="info">

                <div class="informacion">
                    <div class="nombre-y-puntos">
                        <h3>{{ $user->nombre }}</h3>
                        <div class="puntos">
                            <span>Puntos de debate: {{ $user->puntos_de_debate }}</span>
                        </div>
                    </div>
                    <p>{{ $user->email }}</p>
                </div>
                <div class="editar">
                    <button type="button" class="boton-editar">Editar</button>
                </div>
            </div>
        </div>
        @if (session('success'))
            <p class="editado">{{ session('success') }}</p>
        @endif
        <div class="participaciones">
            <div class="participacion" data-label="Temas en los que has participado: ">
                <ul class="participacion-list">
                    @forelse ($temasParticipados as $tema)
                        <li>{{ $tema->titulo }}</li>
                    @empty
                        <li class="sin-participacion">Aún no has participado en ningún tema.</li>
                    @endforelse
                </ul>
            </div>
            <div class="mejor-argumento" data-label="Tu mejor argumento">
                {{ $mejorArgumento->contenido ?? 'Aún no has escrito ningún argumento' }}
            </div>
        </div>
        <a id="btnVolver" class="atras-perfil" href="#">Volver</a>
        <div id="modalEditar" class="modal">
            <div class="modal-contenido">
                <span id="cerrarModal" class="cerrar" onclick="closeModal()">&times;</span>
                <h2>Editar perfil</h2>
                <form id="formEditar" method="POST" action="{{ route('perfil.update') }}" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $user->nombre) }}" required>

                    <label for="email">Correo electrónico:</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>

                    <label for="password">Contraseña (mín. 8 caracteres):</label>
                    <input type="password" id="password" name="password" placeholder="Deja vacío para no cambiar">

                    <label for="foto_perfil">Foto de perfil:</label>
                    <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*">

                    <div class="botones">
                        <button type="submit" class="btn-guardar">Guardar cambios</button>
                        <button type="button" class="btn-descartar" onclick="closeModal()">Descartar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script>
        const btnVolver = document.getElementById('btnVolver');

        if (document.referrer) {
            let url = new URL(document.referrer);
            url.searchParams.set('_reload', Date.now());
            btnVolver.href = url.toString();
        } else {
            btnVolver.href = '/';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const botonEditar = document.querySelector('.boton-editar');
            const modal = document.getElementById('modalEditar');
            const cerrar = document.getElementById('cerrarModal');

            botonEditar.addEventListener('click', () => {
                modal.style.display = 'block';
            });

            cerrar.addEventListener('click', () => {
                modal.style.display = 'none';
            });

            window.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });
    </script>

@endsection
