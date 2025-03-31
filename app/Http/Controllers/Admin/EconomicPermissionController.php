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
        $permission = PermisoEconomico::findOrFail($id);  // Cambia aquí también
        $permission->status = 'aprobado';
        $permission->save();

        return back()->with('success', 'Permiso económico aprobado');
    }

    public function reject($id)
    {
        $permission = PermisoEconomico::findOrFail($id);  // Cambia aquí también
        $permission->status = 'rechazado';
        $permission->save();

        return back()->with('success', 'Permiso económico rechazado');
    }

    public function destroy($id)
    {
        PermisoEconomico::findOrFail($id)->delete();  // Cambia aquí también
        return back()->with('success', 'Permiso económico eliminado');
    }
}
