<?php

namespace App\Http\Controllers;

use App\Models\Vacation;
use Illuminate\Http\Request;

class VacationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
    
        Vacation::create([
            'user_id' => auth()->id(),
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'status' => 'pendiente',
        ]);
    
        return back()->with('success', 'Solicitud de vacaciones creada correctamente');
    }
    public function approve(Vacation $vacation)
{
    $vacation->update(['status' => 'aprobado']);
    return back()->with('success', 'Vacaciones aprobadas correctamente');
}

public function reject(Vacation $vacation)
{
    $vacation->update(['status' => 'rechazado']);
    return back()->with('success', 'Vacaciones rechazadas correctamente');
}
}