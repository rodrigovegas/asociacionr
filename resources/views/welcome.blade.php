<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Asociación de Regantes</title>

    {{-- TailwindCSS CDN para estilos bonitos rápidos --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background-image: url('/imagenes/sanjacinto.jpg');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col justify-center items-center text-white bg-green-800 bg-opacity-90">
    <div class="text-center px-6 py-10 bg-green-600 rounded-lg shadow-lg">
        <h1 class="text-4xl font-bold mb-4">Sistema de Gestión - Asociación de Regantes</h1>
        <p class="text-lg mb-6">Administra socios, canales, aportes, reuniones y más desde un solo lugar.</p>

        <div class="flex gap-4 justify-center">
            @if (Route::has('login'))
                <div class="space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="bg-green-500 px-4 py-2 rounded text-white hover:bg-green-600">Panel</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="bg-white text-green-700 px-4 py-2 rounded hover:bg-gray-200">Iniciar sesión</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="bg-white text-green-700 px-4 py-2 rounded hover:bg-gray-200">Registrarse</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
</body>

</html>
