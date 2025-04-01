<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;  // Asegúrate de que esta línea esté presente
use App\Models\PermisoEconomico;
use Illuminate\Http\Request;


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
    
    // Redirige a la lista de permisos con mensaje de éxito
    return redirect()->route('admin.economic-permissions.index')
                    ->with('success', 'Permiso eliminado correctamente');
}

}
