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
                <form action="{{ route('vacations.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900">Fecha de inicio</label>
                            <input type="date" name="start_date" id="start_date" required
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
                                    <form method="POST" action="{{ route('vacations.destroy', $vacation) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('¿Estás seguro de eliminar esta solicitud?')"
                                                class="p-1.5 text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 rounded-lg transition-all"
                                                title="Eliminar solicitud">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
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
                    <form :action="`/vacations/${vacation.id}`" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900">Fecha inicio</label>
                            <input type="date" name="start_date" x-model="vacation.start_date"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>
                        
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900">Fecha fin</label>
                            <input type="date" name="end_date" x-model="vacation.end_date"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>
                        
                        <div class="flex justify-end space-x-3 pt-4">
                            <button type="button" @click="open = false" 
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                                Cancelar
                            </button>
                            <button type="submit" 
                                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                Guardar Cambios
                            </button>
                        </div>
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
@endisset

@vite(['resources/js/app.js'])
@endsection