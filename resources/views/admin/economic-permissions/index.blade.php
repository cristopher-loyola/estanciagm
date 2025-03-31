@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Encabezado -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Gestión de Permisos Económicos</h1>
            <p class="text-gray-600 mt-2">Visualiza y administra las solicitudes de permisos</p>
        </div>

        <!-- Mensajes de éxito o error -->
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="bg-red-100 text-red-800 p-4 rounded-md mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tabla de permisos -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            @if($permissions->isEmpty())
                <div class="p-6 text-center text-gray-500">
                    <p class="text-lg">No hay solicitudes de permisos económicos</p>
                </div>
            @else
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Empleado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha Solicitud</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Periodo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Motivo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($permissions as $permission)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $permission->user->name ?? 'Usuario no asignado' }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $permission->user->email ?? 'Sin correo' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ optional($permission->fecha_solicitud)->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ optional($permission->fecha_inicio)->format('d/m/Y') }} - {{ optional($permission->fecha_fin)->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $permission->motivo }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                    @if($permission->estado == 'aprobado') bg-green-100 text-green-800
                                    @elseif($permission->estado == 'rechazado') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800 @endif">
                                    {{ ucfirst($permission->estado) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    @if($permission->estado == 'pendiente')
                                        <a href="{{ route('admin.economic-permissions.approve', $permission->id) }}" 
                                           class="text-green-600 hover:text-green-900"
                                           onclick="return confirm('¿Aprobar este permiso?')">
                                            Aprobar
                                        </a>
                                        <a href="{{ route('admin.economic-permissions.reject', $permission->id) }}" 
                                           class="text-red-600 hover:text-red-900"
                                           onclick="return confirm('¿Rechazar este permiso?')">
                                            Rechazar
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.economic-permissions.destroy', $permission->id) }}" 
                                       class="text-gray-600 hover:text-gray-900"
                                       onclick="return confirm('¿Eliminar este permiso?')">
                                        Eliminar
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Paginación -->
                <div class="bg-gray-50 px-6 py-3 border-t border-gray-200">
                    {{ $permissions->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
