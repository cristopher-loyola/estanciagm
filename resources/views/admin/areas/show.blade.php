@extends('layouts.admin')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Empleados del área de {{ $area->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($users as $user)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6 flex flex-col h-full">
                        <!-- Círculo con inicial -->
                        <div class="mx-auto mb-4 w-20 h-20 rounded-full bg-gradient-to-r 
                            @if($user->role === 'admin') from-red-400 to-red-600
                            @elseif($user->role === 'director') from-blue-400 to-blue-600
                            @else from-green-400 to-green-600 @endif
                            flex items-center justify-center">
                            <span class="text-white text-3xl font-black">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </span>
                        </div>
                        
                        <!-- Nombre y Rol -->
                        <div class="text-center mb-4">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $user->name }}</h3>
                            <span class="text-sm 
                                @if($user->role === 'admin') text-red-600
                                @elseif($user->role === 'director') text-blue-600
                                @else text-green-600 @endif">
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>
                        
                        <!-- Detalles -->
                        <div class="space-y-2 mb-6">
                            <p class="text-center text-gray-600 text-sm">
                                <i class="fas fa-envelope mr-2"></i>{{ $user->email }}
                            </p>
                            <p class="text-center text-gray-600 text-sm">
                                <i class="fas fa-user-tie mr-2"></i>
                                {{ $user->director->name ?? 'N/A' }}
                            </p>
                        </div>

                        <!-- Solicitudes de Vacaciones -->
                        <div class="bg-gray-100 p-4 rounded-lg text-sm">
                            <h4 class="font-semibold mb-2">Solicitudes de Vacaciones</h4>
                            @forelse($user->vacations as $vacation)
                                <div class="p-2 rounded-md border mb-2
                                    @if($vacation->status === 'aprobado') border-green-500 text-green-600
                                    @elseif($vacation->status === 'rechazado') border-red-500 text-red-600
                                    @else border-yellow-500 text-yellow-600 @endif">
                                    <p><strong>Inicio:</strong> {{ $vacation->start_date }}</p>
                                    <p><strong>Fin:</strong> {{ $vacation->end_date }}</p>
                                    <p><strong>Estado:</strong> {{ ucfirst($vacation->status) }}</p>
                                    
                                    @if($vacation->status === 'pendiente')
                                    <div class="mt-2 flex justify-center space-x-2">
                                        <form action="{{ route('vacations.approve', $vacation) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 bg-green-600 text-white text-xs rounded-md hover:bg-green-700 transition-colors">
                                                Aprobar
                                            </button>
                                        </form>
                                        <form action="{{ route('vacations.reject', $vacation) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white text-xs rounded-md hover:bg-red-700 transition-colors">
                                                Rechazar
                                            </button>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                            @empty
                                <p class="text-gray-500">No ha solicitado vacaciones.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full p-6 bg-blue-50 rounded-xl">
                    <p class="text-center text-blue-800">
                        No hay empleados en esta área
                    </p>
                </div>
                @endforelse
            </div>
            
            <!-- Paginación -->
            <div class="mt-6">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection