@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <!-- Encabezado con icono -->
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex align-items-center">
                <i class="fas fa-building me-3 fs-4"></i>
                <h2 class="mb-0">Gestión de Permisos por Área</h2>
            </div>
            <p class="mb-0 mt-2">Seleccione el área cuyos permisos desea gestionar</p>
        </div>

        <!-- Contenido -->
        <div class="card-body">
            @if($areas->isEmpty())
                <div class="alert alert-warning text-center py-4">
                    <i class="fas fa-exclamation-triangle fa-2x mb-3"></i>
                    <h4>No hay áreas registradas</h4>
                    <p class="mb-0">Contacte al administrador del sistema</p>
                </div>
            @else
                <div class="row g-4">
                    @foreach($areas as $area)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <!-- Tarjeta de área -->
                        <div class="card h-100 border-0 shadow-sm hover-lift">
                            <a href="{{ route('admin.economic-permissions.by-area', $area) }}" class="text-decoration-none text-dark">
                                <div class="card-body text-center py-4">
                                    <!-- Icono del área -->
                                    <div class="icon-circle bg-primary bg-opacity-10 text-primary mb-3 mx-auto">
                                        <i class="fas fa-users fa-lg"></i>
                                    </div>
                                    
                                    <!-- Nombre del área -->
                                    <h4 class="h5 mb-2">{{ $area->nombre }}</h4>
                                    
                                    <!-- Contador de pendientes (opcional) -->
                                    <div class="badge bg-primary bg-opacity-10 text-primary rounded-pill mb-3">
                                        {{-- $area->permisos_pendientes_count --}} Permisos
                                    </div>
                                    
                                    <!-- Texto de acción -->
                                    <p class="small text-muted mb-0">
                                        <i class="fas fa-mouse-pointer me-1"></i>Click para gestionar
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Efecto hover para las tarjetas */
    .hover-lift {
        transition: all 0.2s ease;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 1.5rem rgba(0, 0, 0, 0.1) !important;
    }
    
    /* Círculo para iconos */
    .icon-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Mejora el gradiente del encabezado */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
    }
</style>
@endpush
@endsection