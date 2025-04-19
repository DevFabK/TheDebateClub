<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TDC - Registro</title>
    <link href="{{ asset('css/fondo-formularios.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/estilos-formularios.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="contenedor">
        <div class="contenido">
            <!-- Contenedor del título -->
            <div class="titulo">
                THE DEBATE CLUB
            </div>

            <!-- Si sale cualquier error aparece en la vista en color rojo -->
            @if ($errors->any())
            <div class="errores" style="color: red; font-weight: bold; margin-bottom: 15px;">
                <ul class="lista-errores">
                    @foreach ($errors->all() as $error)
                    <li class="item-lista-errores">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <!-- Formulario de registro -->
            <div class="formulario-contenedor">
                <form action="{{ route('registro') }}" method="POST" novalidate>
                    @csrf

                    <div class="contenedor__entrada" data-label="Nombre">
                        <div class="icono__contenedor">
                            <!-- Icono de usuario -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-user-round-icon lucide-circle-user-round">
                                <path d="M18 20a6 6 0 0 0-12 0" />
                                <circle cx="12" cy="10" r="4" />
                                <circle cx="12" cy="12" r="10" />
                            </svg>
                        </div>
                        <input type="text" name="nombre" placeholder="Nombre" class="entrada__busqueda" />
                        <div class="sombra"></div>
                    </div>

                    <div class="contenedor__entrada" data-label="Correo">
                        <div class="icono__contenedor">
                            <!-- Icono de correo -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-at-sign-icon lucide-at-sign">
                                <circle cx="12" cy="12" r="4" />
                                <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-4 8" />
                            </svg>
                        </div>
                        <input type="email" name="email" placeholder="Email" class="entrada__busqueda" />
                        <div class="sombra"></div>
                    </div>

                    <div class="contenedor__entrada" data-label="Contraseña">
                        <div class="icono__contenedor">
                            <!-- Icono de contraseña -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock-keyhole-icon lucide-lock-keyhole">
                                <circle cx="12" cy="16" r="1" />
                                <rect x="3" y="10" width="18" height="12" rx="2" />
                                <path d="M7 10V7a5 5 0 0 1 10 0v3" />
                            </svg>
                        </div>
                        <input type="password" name="password" placeholder="Contraseña" class="entrada__busqueda" />
                        <div class="sombra"></div>
                    </div>

                    <div class="contenedor__boton">
                        <button type="submit" class="boton__entrada__sombra">
                            Registrarse
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>