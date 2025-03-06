@extends('layouts.app')
@vite(['resources/css/app.css','resources/js/app.js'])
@section('content')

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-4">
        <!-- Sidebar de navegación -->
        <aside class="w-full md:w-1/4">
            <div class="bg-white rounded-lg shadow p-4">
                <h2 class="text-xl font-semibold mb-4">Menú Admin</h2>
                <ul class="space-y-2">
                    <li>
                        <div class="flex items-center text-gray-700">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6"></path>
                            </svg>
                            Dashboard
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center text-gray-700">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M12 11a4 4 0 100-8 4 4 0 000 8z"></path>
                            </svg>
                            Usuarios
                        </div>
                    </li>
                    <!-- Más elementos de menú según tus necesidades -->
                </ul>
            </div>
        </aside>

        <!-- Contenido principal -->
        <main class="w-full md:w-3/4">
            <div class="bg-white rounded-lg shadow p-6">
                <h1 class="text-2xl font-bold mb-4">Bienvenido, {{ auth()->user()->name }}</h1>
                <p class="mb-6 text-gray-600">Este es tu panel de administración, donde puedes gestionar usuarios, configuraciones y más.</p>
                
                <div class="bg-blue-100 p-4 rounded-lg mb-6">
                    <h2 class="text-xl font-semibold text-blue-600">¿Qué te gustaría hacer hoy?</h2>
                    <p class="text-gray-700">Desde este panel puedes gestionar tus usuarios, ver estadísticas y mucho más.</p>
                </div>

                <!-- Botones de acción -->
                <div class="flex space-x-4">
                    <button class="inline-block bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">
                        Crear Nuevo Usuario
                    </button>
                    <button class="inline-block bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600">
                        Ver Dashboard
                    </button>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
