@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-4">
        <!-- Sidebar de navegación -->
        <aside class="w-full md:w-1/4">
            <div class="bg-white rounded-lg shadow p-4">
                <h2 class="text-xl font-semibold mb-4">Menú Admin</h2>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <!-- Icono de dashboard (ejemplo) -->
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6"></path>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <!-- Icono de usuarios (ejemplo) -->
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M12 11a4 4 0 100-8 4 4 0 000 8z"></path>
                            </svg>
                            Usuarios
                        </a>
                    </li>
                    <!-- Más elementos de menú según tus necesidades -->
                </ul>
            </div>
        </aside>

        <!-- Contenido principal -->
        <main class="w-full md:w-3/4">
            <div class="bg-white rounded-lg shadow p-6">
                <h1 class="text-2xl font-bold mb-4">Bienvenido, {{ auth()->user()->name }}</h1>
                <p class="mb-6">Panel de administración usando Flowbite y Tailwind CSS.</p>
                
                <!-- Ejemplo de formulario para crear un nuevo usuario -->
                <h2 class="text-xl font-semibold mb-2">Crear Nuevo Usuario</h2>
                @if(session('success'))
                    <div class="p-4 mb-4 text-green-800 bg-green-100 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="name" id="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Correo</label>
                        <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                        <input type="password" name="password" id="password" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700">Rol</label>
                        <select name="role" id="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="admin">Admin</option>
                            <option value="director">Director</option>
                            <option value="empleado">Empleado</option>
                            <option value="honorario">Honorario</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Crear Usuario
                    </button>
                </form>
            </div>
        </main>
    </div>
</div>
@endsection
