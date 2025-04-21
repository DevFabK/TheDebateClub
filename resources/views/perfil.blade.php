@extends('layouts.app')

@section('perfil', 'Perfil')

@section('content')

<div class="contenido">
    <div class="informacion">
        <div class="personal">
            <div class="foto"></div>
            <div class="nombre"></div>
            <div class="correo"></div>
        </div>
        <div class="puntos">
            <h2>PUNTOS DE DEBATE: </h2>
        </div>
    </div>
    <div class="publicaciones">
        <div class="participado">
            <h3>Has participado en: </h3>
            <hr>
            <ul>
                <li><a href="#">TEMA 1</a></li>
                <li>TEMA 2</li>
                <li>TEMA 3</li>
                <li>TEMA 4</li>
            </ul>
        </div>
        <div class="mejor-argumento">
            <h3>TU ARGUMENTO MAS VOTADO</h3>
            <div class="argumento overflow-y-hidden"></div>
        </div>
    </div>
    <div class="borrar">
        <button>BORRAR PERFIL</button>
    </div>
</div>
@endsection