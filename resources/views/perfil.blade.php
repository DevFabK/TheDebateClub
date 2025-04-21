@extends('layouts.app')

@section('perfil', 'Perfil')

@section('styles')
<link href="{{ asset('css/estilos-perfil.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="fondo">
    <div class="contenido">
        <div class="informacion">
            <div class="personal">
                <div class="foto"></div>
                <div class="info">
                    <div class="nombre">NOMBRE</div>
                    <div class="correo">CORREO</div>
                </div>
            </div>
            <div class="puntos">
                <h2>PUNTOS DE DEBATE:</h2>
                <div class="puntos-valor">
                    <span class="puntos-numero">Nx</span>
                    <span class="icono">ICO</span>
                </div>
            </div>
        </div>
        <div class="publicaciones">
            <div class="participado">
                <h3>HAS PARTICIPADO EN:</h3>
                <hr>
                <ul>
                    <li><a href="#">TEMA 1</a></li>
                    <li>TEMA 2</li>
                    <li>TEMA 3</li>
                    <li>TEMA 3</li>
                </ul>
            </div>
            <div class="mejor-argumento">
                <h3>TU MEJOR ARGUMENTO</h3>
                <div class="argumento">
                    <div class="argumento-titulo">ARGUMENTO CON MAS VOTOS</div>
                    <div class="argumento-contenido">
                        <div class="linea-ondulada"></div>
                        <div class="linea-ondulada"></div>
                        <div class="linea-ondulada"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="borrar">
            <button>BORRAR</button>
        </div>
    </div>
</div>
@endsection