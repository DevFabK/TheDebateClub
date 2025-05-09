@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

<div class="crear-wrapper">
    <div class="header-container">
        <div class="titulo-crear">
            <h2>ESCRIBE TU POST</h2>
        </div>
        <div id="input-wrapper"></div>
    </div>

    <div class="seleccion-crear">
        <form action="">
            <div class="seleccion-wrapper" id="seleccion-wrapper">
                <select name="seleccion" id="eleccion" class="seleccion">
                    <option value="debate" selected class="opciones">DEBATE</option>
                    <option value="argumento" class="opciones">ARGUMENTO</option>
                </select>
            </div>
            <textarea name="argumento-usuario" id="argumento-usuario"></textarea>
            <button class="publicar" value="Publicar">PUBLICAR</button>
        </form>
    </div>
</div>

<script>
    const seleccion = document.getElementById("eleccion");
    const inputWrapper = document.getElementById("input-wrapper");
    let input = null;

    function crearInput() {
        input = document.createElement("input");
        input.setAttribute("id", "input");
        input.setAttribute("name", "titulo-debate");
        input.setAttribute("placeholder", "Título del debate");
        input.type = "text";
        input.classList.add("input", "smooth-type", "titulo-debate"); 
        inputWrapper.appendChild(input);
    }

    function eliminarInput() {
        if (input) {
            inputWrapper.removeChild(input);
            input = null;
        }
    }

    window.addEventListener("DOMContentLoaded", () => {
        if (seleccion.value === "debate") {
            crearInput();
        }
    });

    seleccion.addEventListener("change", () => {
        if (seleccion.value === "debate") {
            if (!input) crearInput();
        } else {
            eliminarInput();
        }
    });
</script>

@endsection