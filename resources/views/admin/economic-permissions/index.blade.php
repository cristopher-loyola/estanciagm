@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Gestión de Permisos Económicos</h1>
            <p class="text-gray-600 mt-2">Administración de solicitudes del equipo</p>
            
            <div class="mt-4 flex items-center justify-between">
                <div class="bg-white px-4 py-2 rounded-lg shadow-sm inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span class="font-medium">{{ $permissions->count() }} solicitudes</span>
                </div>
                
                <div class="relative w-64">
                    <input type="text" placeholder="Buscar..." class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Mensajes de éxito o error -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @elseif(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <p>{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <!-- Tabla simplificada -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            @if($permissions->isEmpty())
                <div class="p-8 text-center">
                    <div class="text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="mt-4 text-gray-700">No hay solicitudes de permisos económicos</p>
                    </div>
                </div>
            @else
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Empleado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Solicitud</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Periodo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Motivo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($permissions as $permission)
                        <tr class="hover:bg-gray-50">
                            <!-- Columna Empleado -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                        <span class="text-blue-600 font-medium">{{ substr($permission->user->name ?? 'U', 0, 1) }}</span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $permission->user->name ?? 'Usuario no asignado' }}</div>
                                        <div class="text-xs text-gray-500">{{ $permission->user->email ?? 'Sin correo' }}</div>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Columna Fecha Solicitud -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ optional($permission->fecha_solicitud)->format('d M Y') }}
                                </div>
                                <div class="text-xs text-gray-500 mt-1">
                                    {{ optional($permission->fecha_solicitud)->diffForHumans() }}
                                </div>
                            </td>
                            
                            <!-- Columna Periodo -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ optional($permission->fecha_inicio)->format('d M Y') }} - {{ optional($permission->fecha_fin)->format('d M Y') }}
                                </div>
                                <div class="text-xs text-gray-500 mt-1">
                                    {{ optional($permission->fecha_inicio)->diffInDays($permission->fecha_fin) + 1 }} días
                                </div>
                            </td>
                            
                            <!-- Columna Motivo -->
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $permission->motivo }}">
                                    {{ $permission->motivo }}
                                </div>
                            </td>
                            
                            <!-- Columna Estado -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                    @if($permission->estado == 'aprobado') bg-green-100 text-green-800
                                    @elseif($permission->estado == 'rechazado') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800 @endif">
                                    {{ ucfirst($permission->estado) }}
                                </span>
                            </td>
                            
                            <!-- Columna Acciones -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    @if($permission->estado == 'pendiente')
                                    <form action="{{ route('admin.economic-permissions.approve', $permission->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" 
                                                class="text-green-600 hover:text-green-900"
                                                onclick="return confirm('¿Aprobar este permiso?')"
                                                title="Aprobar">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('admin.economic-permissions.reject', $permission->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-900"
                                                onclick="return confirm('¿Rechazar este permiso?')"
                                                title="Rechazar">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>
                                    @endif
                                    
                                    <form action="{{ route('admin.economic-permissions.destroy', $permission->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-gray-600 hover:text-gray-900"
                                                onclick="return confirm('¿Eliminar este permiso permanentemente?')"
                                                title="Eliminar">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Paginación simple -->
                @if($permissions->hasPages())
                <div class="bg-gray-50 px-6 py-3 border-t border-gray-200">
                    {{ $permissions->links() }}
                </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection