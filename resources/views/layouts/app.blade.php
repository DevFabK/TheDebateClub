<!DOCTYPE html>
<html lang="es">

<head>
    @vite(['public/css/estilos-crear.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>The Debate Club - @yield('title', 'Home')</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="{{ asset('css/header.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet" />
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link href="{{ asset('css/estilos-home.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/fondo-general.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/estilos-crear.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/estilos-tema.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/estilos-panel-admin.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/layout-principal.css') }} ">

    @yield('styles')

</head>

<body>
    @include('components.header')

    <main class="contenido">
        @yield('content')
    </main>

    @include('components.footer')
    @yield('scripts')
</body>

</html>
<script>
    (function() {
        let historyList = JSON.parse(sessionStorage.getItem('customHistory')) || [];
        const current = window.location.pathname + window.location.search;

        if (historyList[historyList.length - 1] !== current) {
            historyList.push(current);
        }

        sessionStorage.setItem('customHistory', JSON.stringify(historyList));
    })();
</script>
