@extends('layouts.app')

@section('title', 'Crear')

@section('content')
    <div class="crear-wrapper">
        <div class="header-container">
            <div class="titulo-crear">
                <h2>ESCRIBE TU POST</h2>
            </div>
        </div>

        <div class="seleccion-crear">
            <form method="POST" action="{{ route('crear.post') }}">
                @csrf
                <div class="seleccion-wrapper" id="seleccion-wrapper">
                    <select name="eleccion" id="eleccion" class="seleccion">
                        <option value="debate" {{ old('eleccion') === 'debate' ? 'selected' : '' }} class="opciones">DEBATE
                        </option>
                        <option value="argumento" {{ old('eleccion') === 'argumento' ? 'selected' : '' }} class="opciones">
                            ARGUMENTO</option>
                    </select>
                </div>
                <input id="texto" name="texto" type="text" style="display: none">

                <div id="debate-wrapper" style="display: none;">
                    <input id="titulo-debate" name="titulo-debate" placeholder="Título del debate" type="text"
                        class="input smooth-type titulo-debate" value="{{ old('titulo-debate') }}">

                    <select name="tema_id" id="tema_id" class="input smooth-type selector-tema">
                        <option disabled {{ old('tema_id') ? '' : 'selected' }} value="">Selecciona un tema...
                        </option>
                        @foreach ($temas as $tema)
                            <option value="{{ $tema->id }}" {{ old('tema_id') == $tema->id ? 'selected' : '' }}>
                                {{ $tema->titulo }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div id="argumento-wrapper" style="display: none;">
                    <div class="argumento-container">
                        <select name="debate_id" id="debate_id" class="input smooth-type selector-debate">
                            <option disabled {{ old('debate_id') ? '' : 'selected' }} value="">Selecciona un debate...
                            </option>
                            @foreach ($debates as $debate)
                                <option value="{{ $debate->id }}"
                                    {{ old('debate_id') == $debate->id ? 'selected' : '' }}>
                                    {{ $debate->titulo }}
                                </option>
                            @endforeach
                        </select>
                        <input type="hidden" name="postura" id="postura-input" value="Neutral">
                        <div class="postura" id="postura">
                            <p>POSTURA: </p>
                            <div class="iconos-postura">
                                <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17 18L12 13L7 18M17 11L12 6L7 11" stroke="#777" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 15L12 9L18 15" stroke="#777" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 15L12 20L17 15M7 9L12 4L17 9" stroke="#777" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 9L12 15L18 9" stroke="#777" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 13L12 18L17 13M7 6L12 11L17 6" stroke="#777" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <textarea name="texto-usuario" id="texto-usuario">{{ old('texto-usuario') }}</textarea>
                <button type="submit" class="publicar" value="Publicar" id="enviar">PUBLICAR</button>

                @if ($errors->any())
                    <div class="errores-validacion" style="color: red; margin-bottom: 20px;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
        </div>
    </div>

    <script>
        const debateWrapper = document.getElementById("debate-wrapper");
        const seleccion = document.getElementById("eleccion");
        const argumentoWrapper = document.getElementById("argumento-wrapper");

        // Colores de las posturas 
        const colores = [
            "#00ff00", // Verde 
            "#66cc66", // Verde apagado
            "#282828", // Gris diferente a #777
            "#cc6666", // Rojo apagado
            "#ff0000" // Rojo 
        ];

        const coloresFondo = [
            "#ccffcc", // Fondo verde claro
            "#e6f2e6", // Fondo verde más apagado
            "#dddddd", // Fondo gris claro
            "#f2dede", // Fondo rojo apagado
            "#ffcccc" // Fondo rojo
        ];
        
        const svgs = document.querySelectorAll('.iconos-postura svg');
        
        svgs.forEach((svg, index) => {
            svg.addEventListener('click', () => {
                svgs.forEach(s => {
                    const path = s.querySelector('path');
                    path.setAttribute('stroke', '#777');
                    s.style.backgroundColor = 'transparent';
                });
                
                const path = svg.querySelector('path');
                path.setAttribute('stroke', colores[index]);
                svg.style.backgroundColor = coloresFondo[index];
                const posturas = ['A favor', 'Parcialmente a favor', 'Neutral', 'Parcialmente en contra', 'En contra'];
                document.getElementById('postura-input').value = posturas[index];
                console.log(posturas[index]);
            });
        });

        function actualizarVisibilidadInputs() {
            if (seleccion.value === "debate") {
                debateWrapper.style.display = "flex";
                debateWrapper.style.flexDirection = "column";
                debateWrapper.style.gap = "15px";
                document.getElementById("titulo-debate").required = true;
                document.getElementById("tema_id").required = true;

                // Ocultar sección de argumentos
                argumentoWrapper.style.display = "none";
                document.getElementById("debate_id").required = false;
            } else if (seleccion.value === "argumento") {
                // Mostrar sección de argumentos
                argumentoWrapper.style.display = "flex";
                argumentoWrapper.style.justifyContent = "space-between";
                document.getElementById("debate_id").required = true;

                // Ocultar sección de debates
                debateWrapper.style.display = "none";
                document.getElementById("titulo-debate").required = false;
                document.getElementById("tema_id").required = false;
            }
        }

        window.addEventListener("DOMContentLoaded", () => {
            actualizarVisibilidadInputs();
        });

        seleccion.addEventListener("change", actualizarVisibilidadInputs);
    </script>
@endsection
