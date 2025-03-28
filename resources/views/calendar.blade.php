@extends('layouts.app')

@section('title', 'Calendario de Vacaciones')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Encabezado -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Calendario de Vacaciones</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Sección principal del calendario -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Calendario -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div id="calendar" class="w-full"></div>
            </div>

            <!-- Formulario de solicitud -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Solicitar Nuevas Vacaciones</h2>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Recuerda que solo son 10 dias habiles por cada 6 meses</h3>
               <!-- Formulario de solicitud -->
<div class="bg-white rounded-xl shadow-md p-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Solicitar Vacaciones</h2>
    <form action="{{ route('vacations.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label>Fecha de inicio</label>
                <input type="date" name="start_date" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label>Fecha de fin</label>
                <input type="date" name="end_date" required class="w-full p-2 border rounded">
            </div>
        </div>
        <button type="submit" class="bg-blue-500 text-white p-2 rounded">
            Enviar Solicitud
        </button>
    </form>
</div>
            </div>
        </div>

        <!-- Panel lateral con solicitudes -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Mis Solicitudes</h2>
                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                        {{ $vacations->count() }} registros
                    </span>
                </div>
                
                @if($vacations->isEmpty())
                    <div class="text-center py-6">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="mt-2 text-gray-500">No tienes solicitudes registradas</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($vacations as $vacation)
                        <div class="relative border rounded-xl p-5 transition-all hover:shadow-lg {{ 
                            $vacation->status == 'aprobado' ? 'border-green-200 bg-green-50' : 
                            ($vacation->status == 'rechazado' ? 'border-red-200 bg-red-50' : 'border-yellow-200 bg-yellow-50')
                        }}">
                            <!-- Badge de estado -->
                            <span class="absolute -top-2 -right-2 px-3 py-1 text-xs font-bold rounded-full shadow-md {{ 
                                $vacation->status == 'aprobado' ? 'bg-green-500 text-white' : 
                                ($vacation->status == 'rechazado' ? 'bg-red-500 text-white' : 'bg-yellow-500 text-white')
                            }}">
                                {{ ucfirst($vacation->status) }}
                            </span>

                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-bold text-gray-800">
                                        {{ $vacation->start_date->format('d M Y') }} - {{ $vacation->end_date->format('d M Y') }}
                                    </h4>
                                    <p class="text-sm text-gray-600 mt-1">
                                        <i class="far fa-clock mr-1"></i> {{ $vacation->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                
                                <!-- Acciones -->
                                <div class="flex space-x-2">
                                    @if($vacation->status == 'pendiente')
                                    <!-- Botón Editar -->
                                    <button @click="openEditModal({{ $vacation->id }})" 
                                            class="p-1.5 text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 rounded-lg transition-all"
                                            title="Editar solicitud">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </button>
                                    @endif
                                    
                                    <!-- Botón Eliminar -->
                                    <form action="{{ route('vacations.destroy', $vacation->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Eliminar</button>
</form>
                                </div>
                            </div>
                            
                            @if($vacation->status == 'rechazado' && $vacation->comments)
                            <div class="mt-3 p-3 bg-red-50 rounded-lg">
                                <div class="flex items-start">
                                    <svg class="flex-shrink-0 h-5 w-5 text-red-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                    </svg>
                                    <div class="ml-2">
                                        <p class="text-sm text-red-700"><span class="font-medium">Motivo:</span> {{ $vacation->comments }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal para edición -->
<div x-data="{ open: false, vacation: null }" x-cloak>
    <div x-show="open" x-transition class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50">
        <div @click.away="open = false" class="bg-white rounded-xl shadow-xl w-full max-w-md">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Editar Solicitud</h3>
                <template x-if="vacation">
                <form action="{{ route('vacations.store') }}" method="POST" class="space-y-4" id="vacationForm">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900">Fecha de inicio</label>
            <input type="date" name="start_date" id="start_date" required
                   min="{{ now()->format('Y-m-d') }}"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900">Fecha de fin</label>
            <input type="date" name="end_date" id="end_date" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
    </div>
    <button type="submit" 
            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center shadow-lg transition-all">
        <i class="fas fa-paper-plane mr-2"></i> Enviar Solicitud
    </button>
</form>
                </template>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
function openEditModal(vacationData) {
    const modal = document.querySelector('[x-data]').__x.$data;
    modal.vacation = {
        id: vacationData.id,
        start_date: vacationData.start_date,  // Usamos los datos del parámetro
        end_date: vacationData.end_date      // Usamos los datos del parámetro
    };
    modal.open = true;
}
</script>

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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('vacationForm');
    const startDate = document.getElementById('start_date');
    const endDate = document.getElementById('end_date');
    
    // Actualizar fecha mínima de end_date cuando cambia start_date
    startDate.addEventListener('change', function() {
        endDate.min = this.value;
    });
    
    // Validar fechas antes de enviar
    form.addEventListener('submit', function(e) {
        if (new Date(endDate.value) < new Date(startDate.value)) {
            e.preventDefault();
            alert('La fecha de fin debe ser posterior a la fecha de inicio');
            return false;
        }
        
        // Validar días hábiles (10 días máximo)
        const start = new Date(startDate.value);
        const end = new Date(endDate.value);
        const diffTime = Math.abs(end - start);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
        
        if (diffDays > 10) {
            e.preventDefault();
            alert('Solo puedes solicitar máximo 10 días hábiles de vacaciones');
            return false;
        }
        
        return true;
    });
});
</script>
@endisset

@vite(['resources/js/app.js'])
@endsection