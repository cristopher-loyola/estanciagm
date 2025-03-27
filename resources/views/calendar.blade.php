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
