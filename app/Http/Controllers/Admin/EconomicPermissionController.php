<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;  // Asegúrate de que esta línea esté presente
use App\Models\PermisoEconomico;
use Illuminate\Http\Request;
use App\Models\Area;


class EconomicPermissionController extends Controller
{
    public function index()
    {
        // Cambia EconomicPermission por PermisoEconomico
        $permissions = PermisoEconomico::with('user')->latest()->paginate(10);
        return view('admin.economic-permissions.index', compact('permissions'));
    }
    public function approve($id)
    {
        $permission = PermisoEconomico::findOrFail($id);
        $permission->estado = 'aprobado';
        $permission->save();
    
        // Opción 1: Redirigir a la URL anterior (la más segura)
        return back()->with('success', 'Permiso aprobado correctamente');
        
        // Opción 2: Redirigir a una ruta específica (si existe)
        // return redirect()->route('ruta.existente')->with('success', 'Permiso aprobado');
    }

public function reject($id)
{
    $permission = PermisoEconomico::findOrFail($id);
    $permission->estado = 'rechazado';
    $permission->save();

    return back()->with('success', 'Permiso rechazado correctamente');
}

public function destroy($id)
{
    $permission = PermisoEconomico::findOrFail($id); // Usa el nombre correcto del modelo
    $permission->delete();
    
    return back()->with('success', 'Permiso eliminado correctamente');
}

public function selectArea()
{
    $areas = Area::all();
    return view('admin.economic-permissions.select-area', compact('areas'));
}

public function byArea(Area $area)
{
    // Obtener los IDs de usuarios que pertenecen a esta área
    $userIds = $area->users()->pluck('id');
    
    // Obtener los permisos económicos paginados
    $permissions = PermisoEconomico::with(['user', 'area'])
                    ->whereIn('user_id', $userIds)
                    ->orderBy('created_at', 'desc')
                    ->paginate(15); // Cambia 15 por el número de items por página que prefieras
    
    return view('admin.economic-permissions.index', compact('permissions', 'area'));
}

}
