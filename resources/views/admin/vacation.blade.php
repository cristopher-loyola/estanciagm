@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    <h1 class="text-2xl font-semibold mb-6">Solicitudes de Vacaciones</h1>

    <table class="w-full bg-white shadow-md rounded-lg">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">Empleado</th>
                <th class="px-4 py-2">Inicio</th>
                <th class="px-4 py-2">Fin</th>
                <th class="px-4 py-2">Estado</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vacations as $vacation)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $vacation->user->name }}</td>
                    <td class="px-4 py-2">{{ $vacation->start_date }}</td>
                    <td class="px-4 py-2">{{ $vacation->end_date }}</td>
                    <td class="px-4 py-2">{{ ucfirst($vacation->status) }}</td>
                    <td class="px-4 py-2">
                        @if($vacation->status === 'pendiente')
                            <form action="{{ route('vacations.approve', $vacation) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded-lg">Aprobar</button>
                            </form>
                            <form action="{{ route('vacations.reject', $vacation) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg">Rechazar</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
