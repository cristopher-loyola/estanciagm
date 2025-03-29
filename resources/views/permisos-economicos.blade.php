@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary: #3a86ff;
        --success: #4cc9f0;
        --warning: #ffbe0b;
        --danger: #ff006e;
        --light: #f8f9fa;
        --dark: #212529;
        --gray: #6c757d;
        --border: #dee2e6;
    }
    
    body {
        background-color: #f5f7fa;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }
    
    .permisos-container {
        max-width: 800px;
        margin: 2rem auto;
        padding: 0 1rem;
    }
    
    .card {
        background: white;
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        margin-bottom: 1.5rem;
        overflow: hidden;
    }
    
    .card-header {
        background: var(--primary);
        color: white;
        padding: 1rem 1.5rem;
        font-weight: 600;
    }
    
    .card-body {
        padding: 1.5rem;
    }
    
    .progress {
        height: 6px;
        background-color: #e9ecef;
        border-radius: 3px;
    }
    
    .progress-bar {
        background-color: var(--primary);
        transition: width 0.6s ease;
    }
    
    .form-label {
        font-weight: 500;
        color: var(--dark);
        margin-bottom: 0.5rem;
        display: block;
    }
    
    .form-control {
        border: 1px solid var(--border);
        border-radius: 4px;
        padding: 0.5rem 0.75rem;
        width: 100%;
        transition: border-color 0.15s ease;
    }
    
    .form-control:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 2px rgba(58, 134, 255, 0.1);
    }
    
    .btn {
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 4px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .btn:hover {
        background: #2a75e6;
        transform: translateY(-1px);
    }
    
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .table th {
        text-align: left;
        padding: 0.75rem;
        font-weight: 600;
        color: var(--gray);
        border-bottom: 2px solid var(--border);
    }
    
    .table td {
        padding: 0.75rem;
        border-bottom: 1px solid var(--border);
    }
    
    .badge {
        display: inline-block;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
        font-weight: 600;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 50rem;
    }
    
    .badge-pending {
        background-color: rgba(255, 190, 11, 0.1);
        color: var(--warning);
    }
    
    .badge-approved {
        background-color: rgba(76, 201, 240, 0.1);
        color: var(--success);
    }
    
    .badge-rejected {
        background-color: rgba(255, 0, 110, 0.1);
        color: var(--danger);
    }
    
    .text-muted {
        color: var(--gray);
        font-size: 0.875rem;
    }
    
    .date-chip {
        background-color: rgba(58, 134, 255, 0.1);
        color: var(--primary);
        padding: 0.25em 0.5em;
        border-radius: 4px;
        font-size: 0.875rem;
    }
    
    @media (max-width: 768px) {
        .permisos-container {
            padding: 0 0.5rem;
        }
        
        .card-body {
            padding: 1rem;
        }
    }
</style>

<div class="permisos-container">
    <!-- Header -->
    <div class="card mb-4">
        <div class="card-header">
            Gestión de Permisos Económicos
        </div>
        <div class="card-body">
            <p>Administra tus solicitudes de permisos económicos (límite: 9 por año)</p>
        </div>
    </div>

    <!-- Progress -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <span class="font-weight-500">Permisos utilizados</span>
                <span class="font-weight-500">{{ $permisosUsados }} de 9</span>
            </div>
            <div class="progress mb-3">
                <div class="progress-bar" 
                     style="width: {{ ($permisosUsados / 9) * 100 }}%">
                </div>
            </div>
            <p class="text-muted mb-0">
                {{ $permisosUsados >= 9 ? 'Límite alcanzado' : 
                   ($permisosUsados >= 6 ? 'Quedan pocos permisos' : 'Disponibles') }}
            </p>
        </div>
    </div>

    <!-- Form -->
    <div class="card mb-4">
        <div class="card-header">
            Nueva Solicitud
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('permisos-economicos.store') }}" id="permisoForm">
                @csrf
                
                <div class="mb-3">
                    <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                    <input type="date" 
                           class="form-control" 
                           id="fecha_inicio" 
                           name="fecha_inicio" 
                           required
                           min="{{ date('Y-m-d') }}">
                </div>
                
                <div class="mb-3">
                    <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                    <input type="date" 
                           class="form-control" 
                           id="fecha_fin" 
                           name="fecha_fin" 
                           required
                           min="{{ date('Y-m-d') }}">
                </div>
                
                <div class="mb-4">
                    <label for="motivo" class="form-label">Motivo</label>
                    <select class="form-control" 
                            id="motivo" 
                            name="motivo" 
                            required>
                        <option value="" selected disabled>Seleccionar motivo</option>
                        <option value="Permiso">Permiso</option>
                        <option value="Comision">Comisión</option>
                        <option value="Permiso Economico">Permiso Económico</option>
                        <option value="Licencia(Prestacion)">Licencia (Prestación)</option>
                        <option value="Matrimonio">Matrimonio</option>
                        <option value="Nacimiento">Nacimiento</option>
                        <option value="Fallecimiento de un familiar">Fallecimiento de un familiar</option>
                        <option value="Vacaciones">Vacaciones</option>
                        <option value="Incapacidad">Incapacidad</option>
                    </select>
                </div>
                
                <button type="submit" class="btn w-100">
                    Enviar Solicitud
                </button>
            </form>
        </div>
    </div>

    <!-- History -->
    @if($permisos->count() > 0)
        <div class="card">
            <div class="card-header">
                Historial
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Periodo</th>
                                <th>Motivo</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permisos as $permiso)
                            <tr>
                                <td>{{ $permiso->fecha_solicitud->format('d/m/Y') }}</td>
                                <td>
                                    <span class="date-chip">{{ $permiso->fecha_inicio->format('d/m') }}</span>
                                    →
                                    <span class="date-chip">{{ $permiso->fecha_fin->format('d/m') }}</span>
                                </td>
                                <td>{{ $permiso->motivo }}</td>
                                <td>
                                    <span class="badge badge-{{ $permiso->estado }}">
                                        {{ ucfirst($permiso->estado) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-3 py-2">
                    {{ $permisos->links() }}
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    // Validación de fechas
    document.getElementById('fecha_inicio').addEventListener('change', function() {
        const fechaFin = document.getElementById('fecha_fin');
        fechaFin.min = this.value;
        if (fechaFin.value && fechaFin.value < this.value) {
            fechaFin.value = this.value;
        }
    });

    // Feedback al enviar
    document.getElementById('permisoForm').addEventListener('submit', function(e) {
        const btn = this.querySelector('button[type="submit"]');
        btn.disabled = true;
        btn.textContent = 'Enviando...';
    });
</script>
@endsection