<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Vite (para cargar CSS y JS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <!-- Navigation -->
    @include('layouts.admin-navigation')

    <!-- Page Content -->
    <main>
        @yield('content') {{-- Aquí se insertará el contenido de la vista --}}
    </main>
</body>
</html>