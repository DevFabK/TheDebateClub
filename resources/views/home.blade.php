@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <div class="contenedor">
        <div class="top" data-label="Buscador">
            <h2 class="titulo">Temas de debates</h2>
            <form class="buscador-temas">
                <div class="input-con-icono">
                    <input type="text" placeholder="Buscar temas..." id="buscador">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="icono-busqueda">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
            </form>
        </div>

        <div class="carousel-wrapper">
            <button class="carrusel-btn prev-btn">&#10094;</button>
            <div class="temas-viewport">
                <div class="temas">
                    @foreach ($temasArray as $tema)
                        <a href="{{ route('tema.ver', $tema->id) }}" class="tema">
                            {{ $tema->titulo }}
                        </a>
                    @endforeach
                </div>
            </div>
            <button class="carrusel-btn next-btn">&#10095;</button>
        </div>
        <h2 class="debates-titulo">Debates Destacados</h2>

        <div class="debates-destacados">
            @foreach ($debatesDestacados as $destacado)
                @if ($destacado['debate'])
                    <div class="debate-destacado">
                        <h3 class="titulo-destacado"></h3>
                        <p class="descripcion-destacado"></p>

                        @if ($destacado['argumentoDestacado'])
                            <div class="argumento-destacado">
                                <h4>Argumento más valorado:</h4>
                                <p class="contenido-argumento"></p>
                                <p><strong>Postura:</strong> <span class="postura-argumento"></span></p>
                            </div>
                        @else
                            <p><em>Este debate aún no tiene argumentos destacados.</em></p>
                        @endif
                    </div>
                @else
                    <p><em>No hay debate disponible para este tema.</em></p>
                @endif
            @endforeach
        </div>
    </div>
    <script src="{{ asset('js/buscador.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script src="{{ asset('js/destacados.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Funcionamiento del carrusel
            const temasContainer = document.querySelector('.temas');
            const temasOriginales = document.querySelectorAll('.tema');
            let currentIndex = 0;
            let isTransitioning = false;
            const visibleItems = 3;

            // Botones de navegación
            const prevButton = document.querySelector('.prev-btn');
            const nextButton = document.querySelector('.next-btn');

            // Clonar elementos para el bucle infinito
            function setupInfiniteLoop() {
                // Clonar los primeros elementos y añadirlos al final
                for (let i = 0; i < visibleItems; i++) {
                    const clone = temasOriginales[i].cloneNode(true);
                    temasContainer.appendChild(clone);
                }

                // Clonar los últimos elementos y añadirlos al principio
                for (let i = temasOriginales.length - 1; i >= temasOriginales.length - visibleItems; i--) {
                    const clone = temasOriginales[i].cloneNode(true);
                    temasContainer.insertBefore(clone, temasContainer.firstChild);
                }

                // Ajustar la posición inicial para mostrar los elementos originales
                currentIndex = visibleItems;
                updateCarouselPosition(false);
            }

            // Obtener el ancho fijo de cada tema
            function getTemaWidth() {
                return 200;
            }

            // Función para actualizar la posición del carrusel
            function updateCarouselPosition(animate = true) {
                const temaWidth = getTemaWidth();
                const gap = 20;
                const slideWidth = temaWidth + gap;
                const position = -currentIndex * slideWidth;

                if (!animate) {
                    temasContainer.style.transition = 'none';
                    temasContainer.style.transform = `translateX(${position}px)`;
                    temasContainer.offsetHeight;
                    temasContainer.style.transition = 'transform 0.5s ease-in-out';
                } else {
                    temasContainer.style.transform = `translateX(${position}px)`;
                }
            }

            // Función para mostrar los siguientes temas
            function showNextTemas() {
                if (isTransitioning) return;
                isTransitioning = true;

                currentIndex++;
                updateCarouselPosition();

                // Comprobar si necesitamos hacer el salto al principio
                setTimeout(() => {
                    const totalTemas = document.querySelectorAll('.tema').length;
                    if (currentIndex >= totalTemas - visibleItems) {
                        currentIndex = visibleItems;
                        updateCarouselPosition(false);
                    }
                    isTransitioning = false;
                }, 500);
            }

            // Función para mostrar los temas anteriores
            function showPrevTemas() {
                if (isTransitioning) return;
                isTransitioning = true;

                currentIndex--;
                updateCarouselPosition();

                // Comprobar si necesitamos hacer el salto al final
                setTimeout(() => {
                    if (currentIndex < visibleItems) {
                        const totalTemas = document.querySelectorAll('.tema').length;
                        currentIndex = totalTemas - visibleItems * 2;
                        updateCarouselPosition(false);
                    }
                    isTransitioning = false;
                }, 500);
            }

            // Inicializar carrusel con bucle infinito
            setupInfiniteLoop();

            // Eventos de click para los botones
            prevButton.addEventListener('click', showPrevTemas);
            nextButton.addEventListener('click', showNextTemas);

            // Auto-scroll cada 5 segundos
            let autoScrollInterval = setInterval(showNextTemas, 5000);

            // Detener auto-scroll cuando el mouse está sobre el carrusel
            document.querySelector('.carousel-wrapper').addEventListener('mouseenter', function() {
                clearInterval(autoScrollInterval);
            });

            // Reanudar auto-scroll cuando el mouse sale del carrusel
            document.querySelector('.carousel-wrapper').addEventListener('mouseleave', function() {
                autoScrollInterval = setInterval(showNextTemas, 5000);
            });
        });
    </script>
@endsection
