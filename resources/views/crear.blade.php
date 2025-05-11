@extends('layouts.app')

@section('title', 'Inicio')

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
                        <div class="postura" id="postura">
                            <p>POSTURA: </p>
                            <div class="iconos-postura">
                                <img src="images/double-up.svg" alt="icono de a favor">
                                <img src="images/up.svg" alt="icono de parcialmente a favor">
                                <img src="images/neutral.svg" alt="icono de posicion neutral">
                                <img src="images/down.svg" alt="icono de parcialmente en contra">
                                <img src="images/double-down.svg" alt="icono de en contra">
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
                argumentoWrapper.style.justifyContent="space-between";
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
