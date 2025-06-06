@extends('layouts.app')

@section('title', 'Debate')

@section('styles')
    <link href="{{ asset('css/estilos-tema.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="contenido-tema">
        <div class="titulo-tema" data-label="Tema Principal">
            <h1>{{ $debate->tema->titulo }}</h1>
        </div>

        <div class="debates-container" data-label="Debate">
            <div class="debate-item">
                <div class="debate-titulo">
                    <h3>{{ $debate->titulo }}</h3>
                </div>

                <div class="argumentos-section">
                    @if ($debate->argumentos->isEmpty())
                        <div class="sin-argumentos" data-label="Estado">
                            <p>No hay argumentos aún.</p>
                        </div>
                    @else
                        <div class="argumentos-lista" data-label="Argumentos">
                            @foreach ($debate->argumentos as $argumento)
                                <div class="argumento-item 
                            @if ($argumento->postura == 'A favor') argumento-favor 
                            @elseif($argumento->postura === 'En contra') argumento-contra 
                            @elseif($argumento->postura == 'Parcialmente en contra') argumento-parcial-contra
                            @elseif($argumento->postura == 'Parcialmente a favor') argumento-parcial-favor
                            @else argumento-neutra @endif"
                                    id="argumento-{{ $argumento->id }}" data-numero="{{ $argumento->usuario->nombre }}">

                                    <div class="argumento-contenido contenido-argumento"
                                        id="argumento-contenido-{{ $argumento->id }}"
                                        data-contenido="{{ e($argumento->contenido) }}">
                                    </div>

                                    <div class="argumento-postura" id="postura-{{ $argumento->id }}">
                                        <strong>{{ $argumento->postura }}</strong>
                                    </div>

                                    @if (auth()->check() && auth()->user()->rol->nombre === 'Moderador')
                                        <button class="btn-borrar-argumento" data-id="{{ $argumento->id }}"
                                            data-url="{{ route('borrarArgumento', $argumento->id) }}">
                                            Borrar
                                        </button>
                                    @endif

                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <button id="btnAtrasTema" class="atras-tema">Volver</button>
    <div id="modal-eliminar" class="modal" style="display:none;">
        <div class="modal-content">
            <p id="mensaje-eliminar"></p>
            <div class="modal-buttons">
                <form id="form-eliminar" method="POST" action="#">
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="btn-confirmar-eliminar" class="btn-eliminar">Eliminar</button>
                </form>
                <button id="btn-cancelar-eliminar" class="btn-cancelar">Cancelar</button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    <script>
        // Inicializar la lógica del modal de confirmación de borrado
        document.addEventListener('DOMContentLoaded', () => {
            const botonesBorrar = document.querySelectorAll('.btn-borrar-argumento');
            const modal = document.getElementById('modal-eliminar');
            const btnCancelar = document.getElementById('btn-cancelar-eliminar');
            const formEliminar = document.getElementById('form-eliminar');
            const mensajeEliminar = document.getElementById('mensaje-eliminar');

            botonesBorrar.forEach(boton => {
                boton.addEventListener('click', () => {
                    const url = boton.getAttribute('data-url');
                    const contenido = boton.getAttribute('data-contenido');

                    // Actualiza el mensaje del modal
                    mensajeEliminar.textContent =
                        `¿Quieres eliminar este argumento?`;
                    formEliminar.setAttribute('action', url);

                    // Para mostrar el modal
                    modal.style.display = 'flex';
                });
            });

            // Cancelar el borrado y limpiar valores
            btnCancelar.addEventListener('click', () => {
                modal.style.display = 'none';
                formEliminar.setAttribute('action', '#');
                mensajeEliminar.textContent = '';
            });

            // Cerrar el modal si se hace click fuera
            window.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.style.display = 'none';
                    formEliminar.setAttribute('action', '#');
                    mensajeEliminar.textContent = '';
                }
            });
        });

        document.getElementById('btnAtrasTema').addEventListener('click', function() {
            let historyList = JSON.parse(sessionStorage.getItem('customHistory')) || [];

            // Eliminar la página actual
            historyList.pop();

            // Buscar la última ruta válida
            let lastRoute = '/home';
            while (historyList.length > 0) {
                let candidate = historyList.pop();
                if (candidate !== '/perfil') {
                    lastRoute = candidate;
                    break;
                }
            }

            // Guardar historial actualizado
            sessionStorage.setItem('customHistory', JSON.stringify(historyList));

            // Redirigir
            window.location.href = lastRoute;
        });

        document.addEventListener("DOMContentLoaded", () => {
            // Para cada argumento llama a la función que muestra las estrellas con la valoración del usuario actual
            @foreach ($debate->argumentos as $argumento)
                mostrarEstrellas({{ $argumento->id }}, {{ auth()->id() ?? 'null' }});
            @endforeach

            // Obtenemos todos los elementos con la clase 'contenido-argumento' y se parsea
            document.querySelectorAll('.contenido-argumento').forEach(el => {
                const rawContent = el.dataset.contenido;
                el.innerHTML = rawContent ? marked.parse(rawContent) : "<em>Sin contenido</em>";
            });
        });

        // Muestra la valoración por estrellas de un argumento para un usuario autenticado
        function mostrarEstrellas(argumentoId, usuarioId) {
            // Verificar que el usuario esté autenticado
            if (!usuarioId) {
                console.log('Usuario no autenticado');
                return;
            }

            // Solicitamos la puntuación del usuario para el argumento dado
            fetch(`/estrellas?usuario_id=${usuarioId}&argumento_id=${argumentoId}`)
                .then(response => {
                    if (!response.ok) throw new Error("Respuesta no válida del servidor");
                    return response.json();
                })
                .then(data => {
                    // Obtiene el valor de la puntuación o 0 si no existe
                    let valor = data?.puntuacion?.valor ?? 0;

                    // Busca el contenedor donde insertar las estrellas
                    const contenedor = document.querySelector(`#argumento-contenido-${argumentoId}`);
                    if (!contenedor) {
                        console.error(`No se encontró contenedor para argumento ${argumentoId}`);
                        return;
                    }

                    const html = `
                        <div class="star-rating" style="font-size: 1.5rem; cursor: pointer; user-select: none; margin-top: 10px;" data-argumento-id="${argumentoId}">
                            ${[1, 2, 3, 4, 5].map(i => `<span data-value="${i}" class="star" style="margin-right: 5px;">☆</span>`).join('')}
                        </div>
                        <input type="hidden" class="rating-value" value="${valor}">
                    `;

                    // Se inserta el html con las estrellas
                    contenedor.insertAdjacentHTML("beforeend", html);

                    const starContainer = contenedor.querySelector('.star-rating');
                    setupStarRating(starContainer, argumentoId);
                })
                .catch(error => {
                    console.error("Error al obtener la puntuación:", error);
                });
        }

        // Sistema de valoración por estrellas en un contenedor y guardando la puntuación seleccionada
        function setupStarRating(container, argumentoId) {
            const stars = container.querySelectorAll('.star');
            const ratingInput = container.nextElementSibling;

            stars.forEach(star => {
                star.addEventListener('click', () => {
                    const value = parseInt(star.dataset.value);
                    ratingInput.value = value;
                    updateStars(stars, value);
                    guardarPuntuacion(argumentoId, value);
                });

                star.addEventListener('mouseover', () => {
                    const value = parseInt(star.dataset.value);
                    updateStars(stars, value);
                });

                star.addEventListener('mouseout', () => {
                    const value = parseInt(ratingInput.value);
                    updateStars(stars, value);
                });
            });

            // Mostrar la puntuación actual
            updateStars(stars, parseInt(ratingInput.value));
        }

        function updateStars(stars, value) {
            stars.forEach((star, index) => {
                star.textContent = (index + 1 <= value) ? '★' : '☆';
                star.style.color = (index + 1 <= value) ? '#ffd700' : '#ccc';
            });
        }

        function guardarPuntuacion(argumentoId, value) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (!token) {
                console.error('Token CSRF no encontrado');
                return;
            }

            fetch('/estrellas', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        argumento_id: argumentoId,
                        puntuacion: value
                    })
                })
                .then(async response => {
                    if (!response.ok) {
                        const errorData = await response.json();
                        console.error("Error detalle:", errorData);
                        throw new Error("Error al guardar puntuación");
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Puntuación guardada:', data.mensaje);
                })
                .catch(error => {
                    console.error("Error al guardar la puntuación:", error);
                    alert('Error al guardar la puntuación. Inténtalo de nuevo.');
                });
        }
    </script>
@endsection
