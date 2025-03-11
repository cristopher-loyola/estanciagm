@extends('layouts.admin')

@section('Areas')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestión de Áreas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($areas as $area)
                    <div class="flex flex-col bg-white border rounded-lg shadow-lg overflow-hidden transform transition-all hover:scale-105 hover:shadow-xl">
                        <a href="{{ route('admin.areas.show', $area) }}" class="flex flex-col p-6">
                            <div class="mb-4 flex justify-center items-center">
                                <div class="h-16 w-16 bg-indigo-500 text-white rounded-full flex items-center justify-center text-2xl font-bold">
                                    {{ strtoupper(substr($area->nombre, 0, 1)) }}
                                </div>
                            </div>
                            <h3 class="text-xl font-semibold text-indigo-600 text-center">{{ $area->nombre }}</h3>
                            <p class="mt-2 text-center text-gray-500">
                                {{ $area->users_count }} empleados registrados
                            </p>
                            <div class="mt-4 flex justify-center">
                                <button class="px-4 py-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition-all">
                                    Ver Área
                                </button>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
