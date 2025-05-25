<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TDC - Registro</title>

    <!-- Estilos específicos para registro -->
    <link href="{{ asset('css/fondo-formularios.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/estilos-formularios.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="contenedor">
        <div class="contenido">
            <div class="titulo">THE DEBATE CLUB</div>

            @if ($errors->any())
                <div class="errores" style="color: red; font-weight: bold; margin-bottom: 15px;">
                    <ul class="lista-errores">
                        @foreach ($errors->all() as $error)
                            <li class="item-lista-errores">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="formulario-contenedor">
                <form action="{{ route('registro') }}" method="POST" novalidate>
                    @csrf
                    <!-- Nombre -->
                    <div class="contenedor__entrada" data-label="Nombre">
                        <div class="icono__contenedor">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M18 20a6 6 0 0 0-12 0" />
                                <circle cx="12" cy="10" r="4" />
                                <circle cx="12" cy="12" r="10" />
                            </svg>
                        </div>
                        <input type="text" name="nombre" placeholder="Nombre" class="entrada__busqueda"
                            value="{{ old('nombre') }}" />
                        <div class="sombra"></div>
                    </div>
                    <!-- Email -->
                    <div class="contenedor__entrada" data-label="Correo">
                        <div class="icono__contenedor">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="12" r="4" />
                                <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-4 8" />
                            </svg>
                        </div>
                        <input type="email" name="email" placeholder="Email" class="entrada__busqueda"
                            value="{{ old('email') }}" />
                        <div class="sombra"></div>
                    </div>
                    <!-- Contraseña -->
                    <div class="contenedor__entrada" data-label="Contraseña">
                        <div class="icono__contenedor">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="16" r="1" />
                                <rect x="3" y="10" width="18" height="12" rx="2" />
                                <path d="M7 10V7a5 5 0 0 1 10 0v3" />
                            </svg>
                        </div>
                        <input type="password" name="password" placeholder="Contraseña" class="entrada__busqueda" />
                        <div class="sombra"></div>
                    </div>
                    <!-- Confirmacion -->
                    <div class="contenedor__entrada" data-label="Confirmacion">
                        <div class="icono__contenedor">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="16" r="1" />
                                <rect x="3" y="10" width="18" height="12" rx="2" />
                                <path d="M7 10V7a5 5 0 0 1 10 0v3" />
                            </svg>
                        </div>
                        <input type="password" name="password_confirmation" placeholder="Confirmar contraseña"
                            class="entrada__busqueda" />
                        <div class="sombra"></div>
                    </div>

                    <div class="contenedor__boton">
                        <button type="submit" class="boton__entrada__sombra">Registrarse</button>
                    </div>

                    <div class="otras-opciones">
                        <a href="{{ route('login') }}" class="boton__entrada__sombra">Iniciar sesion</a>
                        <a href="{{ route('home') }}" class="boton__entrada__sombra">Entrar como invitado</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
