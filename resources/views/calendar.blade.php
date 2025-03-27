@extends('layouts.app')

@section('title', 'Calendario')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">Calendario</h1>
        
        <!-- Calendario -->
        <div id="calendar" class="bg-white shadow-md rounded-lg p-6 mb-6"></div> 

        @isset($highlight)
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(isset($highlight['start']) && isset($highlight['end']))
            const start = new Date('{{ $highlight['start']->format('Y-m-d') }}');
            const end = new Date('{{ $highlight['end']->format('Y-m-d') }}');
            
            if (!isNaN(start.getTime()) && !isNaN(end.getTime())) {
                if (typeof calendar !== 'undefined') {
                    calendar.addEvent({
                        title: 'Tus vacaciones',
                        start: start,
                        end: end,
                        color: '#3b82f6',
                        allDay: true
                    });
                    calendar.gotoDate(start);
                }
            }
            @endif
        });
        </script>
        @endisset

        <!-- Formulario de solicitud de vacaciones -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Solicitar Vacaciones</h2>
            <form action="{{ route('vacations.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Fecha de inicio:</label>
                    <input type="date" name="start_date" id="start_date" required 
                           class="mt-1 p-2 w-full border border-gray-300 rounded-lg shadow-sm">
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700">Fecha de fin:</label>
                    <input type="date" name="end_date" id="end_date" required 
                           class="mt-1 p-2 w-full border border-gray-300 rounded-lg shadow-sm">
                </div>
                <button type="submit" 
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Solicitar Vacaciones
                </button>
            </form>
        </div>
    </div>
    <div class="calendar-container">
        <!-- Debajo de tu calendario -->
<div class="mt-5">
    <h3 class="text-xl font-semibold mb-4">Mis Solicitudes de Vacaciones</h3>
    
    @foreach($vacations as $vacation)
    <div class="card mb-3 border rounded-lg p-4 {{ 
        $vacation->status == 'aprobado' ? 'border-green-500 bg-green-50' : 
        ($vacation->status == 'rechazado' ? 'border-red-500 bg-red-50' : 'border-yellow-500 bg-yellow-50')
    }}">
        <div class="flex justify-between items-start">
            <div>
                <h4 class="font-medium">
                    {{ $vacation->start_date->format('d M Y') }} - {{ $vacation->end_date->format('d M Y') }}
                </h4>
                <p class="text-sm">
                    Estado: 
                    <span class="font-bold {{ 
                        $vacation->status == 'aprobado' ? 'text-green-600' : 
                        ($vacation->status == 'rechazado' ? 'text-red-600' : 'text-yellow-600')
                    }}">
                        {{ ucfirst($vacation->status) }}
                    </span>
                </p>
                <p class="text-sm text-gray-600">
                    {{ $vacation->created_at->diffForHumans() }}
                </p>
            </div>
            
            <div class="flex space-x-2">
                @if($vacation->status == 'pendiente')
                <form action="{{ route('vacations.destroy', $vacation) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                        <i class="fas fa-trash"></i> Cancelar
                    </button>
                </form>
                @endif
            </div>
        </div>
        
        @if($vacation->status == 'rechazado' && $vacation->comments)
        <div class="mt-2 p-2 bg-red-100 rounded">
            <p class="text-sm text-red-800"><strong>Motivo:</strong> {{ $vacation->comments }}</p>
        </div>
        @endif
    </div>
    @endforeach
    
    @if($vacations->isEmpty())
    <div class="text-gray-500 py-4 text-center">
        No tienes solicitudes de vacaciones registradas
    </div>
    @endif
</div>
@foreach($vacations as $vacation)
@if($vacation->status == 'pendiente')
<div x-data="{ open: false }" class="inline">
    <button @click="open = true" class="text-blue-600 hover:text-blue-800 text-sm ml-2">
        <i class="fas fa-edit"></i> Editar
    </button>
    
    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div @click.away="open = false" class="bg-white rounded-lg p-6 w-full max-w-md">
            <h3 class="text-lg font-medium mb-4">Editar solicitud</h3>
            
            <form action="{{ route('vacations.update', $vacation) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Fecha inicio</label>
                    <input type="date" name="start_date" 
                           value="{{ old('start_date', $vacation->start_date->format('Y-m-d')) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Fecha fin</label>
                    <input type="date" name="end_date" 
                           value="{{ old('end_date', $vacation->end_date->format('Y-m-d')) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" @click="open = false" 
                            class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800">
                        Cancelar
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                        Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endforeach

    <!-- Tu calendario existente -->

    @if(!empty($selectedRange) && isset($selectedRange['start']) && isset($selectedRange['end']))
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Verificar que las fechas sean válidas
        const startDate = new Date('{{ $selectedRange['start']->format('Y-m-d') }}');
        const endDate = new Date('{{ $selectedRange['end']->format('Y-m-d') }}');
        
        if (!isNaN(startDate.getTime()) && !isNaN(endDate.getTime())) {
            // Implementa tu lógica para resaltar fechas aquí
            console.log('Mostrando rango:', startDate, 'a', endDate);
            
            // Ejemplo con FullCalendar:
            if (typeof calendar !== 'undefined') {
                calendar.addEvent({
                    title: 'Tus vacaciones',
                    start: startDate,
                    end: endDate,
                    color: '#3b82f6',
                    allDay: true
                });
                calendar.gotoDate(startDate);
            }
        }
    });
    </script>
    @endif
</div>

    @vite(['resources/js/app.js'])
@endsection
