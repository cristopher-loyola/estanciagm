<?php

namespace App\Http\Controllers;

use App\Models\PermisoEconomico;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermisoEconomicoController extends Controller
{
    public function index()
    {
        $usuarioId = Auth::id();
        $anoActual = Carbon::now()->year;

        $permisosUsados = PermisoEconomico::where('user_id', $usuarioId)
            ->whereYear('fecha_solicitud', $anoActual)
            ->count();

        $permisos = PermisoEconomico::where('user_id', $usuarioId)
            ->orderBy('fecha_solicitud', 'desc')
            ->paginate(10);

        return view('permisos-economicos', [
            'permisosUsados' => $permisosUsados,
            'permisos' => $permisos
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'motivo' => 'required|string|max:255'
        ]);

        $usuarioId = Auth::id();
        $anoActual = Carbon::now()->year;

        // Validar límite de 9 permisos anuales
        $permisosEsteAno = PermisoEconomico::where('user_id', $usuarioId)
            ->whereYear('fecha_solicitud', $anoActual)
            ->count();

        if ($permisosEsteAno >= 9) {
            return back()->with('error', 'Has excedido el límite de 9 permisos económicos este año.');
        }

        // Crear el permiso económico
        PermisoEconomico::create([
            'user_id' => $usuarioId,
            'fecha_solicitud' => now(),
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'motivo' => $request->motivo,
            'estado' => 'pendiente'
        ]);

        return back()->with('success', 'Permiso económico solicitado correctamente. Permisos restantes: ' . (8 - $permisosEsteAno));
    }
}