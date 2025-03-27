@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Gestión de Vacaciones</h1>
        <div class="text-sm text-gray-600">
            Total: {{ $vacations->count() }} solicitudes
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Empleado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Periodo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Días</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Solicitud</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($vacations as $vacation)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <!-- Columna Empleado -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="text-sm font-medium text-gray-900">{{ $vacation->user->name }}</div>
                            </div>
                        </td>
                        
                        <!-- Columna Periodo -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $vacation->start_date->format('d M Y') }} - {{ $vacation->end_date->format('d M Y') }}
                            </div>
                        </td>
                        
                        <!-- Columna Días -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">
                                {{ $vacation->start_date->diffInDays($vacation->end_date) + 1 }} días
                            </span>
                        </td>
                        
                        <!-- Columna Estado -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ 
                                $vacation->status == 'aprobado' ? 'bg-green-100 text-green-800' : 
                                ($vacation->status == 'rechazado' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800')
                            }}">
                                {{ ucfirst($vacation->status) }}
                            </span>
                        </td>
                        
                        <!-- Columna Fecha Solicitud -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $vacation->created_at->format('d M Y') }}
                        </td>
                        
                        <!-- Columna Acciones -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                @if($vacation->status == 'pendiente')
                                <form action="{{ route('vacations.approve', $vacation) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="text-green-600 hover:text-green-900 flex items-center"
                                            title="Aprobar solicitud">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </button>
                                </form>
                                <form action="{{ route('vacations.reject', $vacation) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-900 flex items-center"
                                            title="Rechazar solicitud">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </form>
                                @endif
                                
                                <!-- Botón Eliminar (visible para todos los estados) -->
                                <form action="{{ route('vacations.destroy', $vacation) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('¿Eliminar permanentemente este registro?')"
                                            class="text-gray-600 hover:text-gray-900 flex items-center"
                                            title="Eliminar registro">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                            No hay solicitudes de vacaciones registradas
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection