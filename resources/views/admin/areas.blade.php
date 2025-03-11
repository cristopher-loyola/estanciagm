@extends('layouts.admin')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Áreas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Asegúrate de tener Tailwind CSS cargado -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($areas as $area)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6 flex flex-col h-full">
                        <!-- Icono/Círculo -->
                        <div class="mx-auto mb-4 w-16 h-16 rounded-full bg-indigo-500 flex items-center justify-center">
                            <span class="text-white text-2xl font-bold">
                                {{ strtoupper(substr($area->nombre, 0, 1)) }}
                            </span>
                        </div>
                        
                        <!-- Contenido -->
                        <h3 class="text-lg font-semibold text-center text-gray-800 mb-2">
                            {{ $area->nombre }}
                        </h3>
                        <p class="text-center text-gray-600 text-sm mb-4">
                            {{ $area->users_count }} empleados
                        </p>
                        
                        <!-- Botones -->
                        <div class="mt-auto flex justify-between space-x-2">
                            <a href="{{ route('admin.areas.edit', $area) }}" 
                               class="flex-1 text-center px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition-colors">
                                Editar
                            </a>
                            <form method="POST" action="{{ route('admin.areas.destroy', $area) }}" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors"
                                        onclick="return confirm('¿Confirmar eliminación?')">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection