<?php

namespace App\Http\Controllers;

use App\Models\Vacation;
use Illuminate\Http\Request;
use App\Notifications\VacationStatusNotification;
use Carbon\Carbon;

class VacationController extends Controller
{

public function index()
{
    $vacations = auth()->user()->vacations()
                    ->orderBy('start_date', 'desc')
                    ->get();
    
    return view('calendar', compact('vacations')); 
}
public function store(Request $request)
{
    $validated = $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    $vacation = Vacation::create([
        'user_id' => auth()->id(),
        'start_date' => Carbon::parse($validated['start_date']),
        'end_date' => Carbon::parse($validated['end_date']),
        'status' => 'pendiente'
    ]);

    auth()->user()->notify(new VacationStatusNotification(
        $vacation,
        'pendiente',
        route('calendar', [
            'highlight_start' => $vacation->start_date->format('Y-m-d'),
            'highlight_end' => $vacation->end_date->format('Y-m-d')
        ])
    ));

    return back()->with('success', 'Solicitud de vacaciones enviada');
}

public function update(Request $request, Vacation $vacation)
{
    // Solo permitir editar si está pendiente
    if ($vacation->status != 'pendiente') {
        abort(403, 'No puedes editar una solicitud ya procesada');
    }

    $validated = $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    $vacation->update($validated);

    return back()->with('success', 'Solicitud actualizada correctamente');
}

// VacationController.php
public function approve(Vacation $vacation)
{
    $vacation->update(['status' => 'aprobado']);
    return back()->with('success', 'Solicitud aprobada correctamente');
}

public function reject(Vacation $vacation)
{
    $vacation->update(['status' => 'rechazado']);
    return back()->with('success', 'Solicitud rechazada correctamente');
}

public function destroy(Vacation $vacation)
{
    $vacation->delete();
    return back()->with('success', 'Registro eliminado permanentemente');
}
}