

@extends('layouts.admin')

@section('content')
<div class="py-12 flex-grow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Título -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900">
                {{ __('Gestión de Áreas') }}
            </h2>
        </div>

        <!-- Grid de tarjetas -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($areas as $area)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="p-6 h-full flex flex-col">
                    
                    <!-- Círculo con inicial -->
                    <div class="mx-auto mb-4 w-20 h-20 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center">
                        <span class="text-white text-3xl font-black">
                            {{ strtoupper(substr($area->nombre, 0, 1)) }}
                        </span>
                    </div>
                    
                    <!-- Nombre del área -->
                    <h3 class="text-center text-xl font-semibold text-gray-800 mb-2">
                        {{ $area->nombre }}
                    </h3>
                    
                    <!-- Conteo de empleados -->
                    <p class="text-center text-gray-600 text-sm mb-6">
                        {{ $area->users_count }} {{ __('Empleados') }}
                    </p>
                    
                    <!-- Botón Consultar -->
                    <div class="mt-auto">
                    <a href="{{ route('admin.economic-permissions.by-area', $area) }}"                           class="w-full block text-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg transition-colors duration-200">
                            🔍 {{ __('Consultar') }}
                        </a>
                    </div>

                </div>
            </div>
            @empty
            <div class="col-span-full p-6 bg-blue-50 rounded-xl">
                <p class="text-center text-blue-800">
                    {{ __('No hay áreas registradas') }}
                </p>
            </div>
            @endforelse
        </div>

    </div>
</div>
@endsection