<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Debate Club - @yield('title', 'Home')</title>
    
    <link href="{{ asset('css/header.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/estilos-home.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/fondo-general.css') }}" rel="stylesheet" />

    @yield('styles') 

</head>
<body>
    @include('components.header') 
    
    <main class="contenido">
        @yield('content') 
    </main>
    
    @include('components.footer')
</body>
</html>
