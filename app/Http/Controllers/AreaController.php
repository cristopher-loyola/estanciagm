<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use App\Models\Vacation;
use App\Models\User;    // Importación para el modelo User


class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areas = Area::withCount('users')->get();
        return view('admin.areas.index', compact('areas')); // Debe coincidir con la ruta de la vista
    }
    

    public function show(Area $area)
    {
        // Paginar los resultados en lugar de obtenerlos todos
        $vacations = Vacation::whereHas('user', function($query) use ($area) {
                        $query->where('id_area', $area->id);
                     })
                     ->orderBy('created_at', 'desc')
                     ->paginate(10); // 10 elementos por página
        
        return view('admin.areas.show', compact('area', 'vacations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Area $area)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        //
    }
}


