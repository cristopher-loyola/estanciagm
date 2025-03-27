<?php

namespace App\Http\Controllers;

use App\Models\Vacation;
use Illuminate\Http\Request;
use App\Notifications\VacationStatusNotification;
use Carbon\Carbon;

class VacationController extends Controller
{

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

    public function approve(Vacation $vacation)
{
    $vacation->update(['status' => 'aprobado']);
    
    $url = route('calendar', [
        'highlight_start' => $vacation->start_date->format('Y-m-d'),
        'highlight_end' => $vacation->end_date->format('Y-m-d')
    ]);

    $vacation->user->notify(new VacationStatusNotification(
        $vacation, 
        'aprobado',
        $url
    ));

    return back()->with('success', 'Vacaciones aprobadas');
}
public function reject(Vacation $vacation)
{
    // Actualiza el estado a "rechazado"
    $vacation->update(['status' => 'rechazado']);
    
    // Prepara la URL para la notificación
    $url = route('calendar', [
        'highlight_start' => $vacation->start_date->format('Y-m-d'),
        'highlight_end' => $vacation->end_date->format('Y-m-d')
    ]);

    // Envía notificación al usuario
    $vacation->user->notify(new VacationStatusNotification(
        $vacation, 
        'rechazado',
        $url
    ));

    return back()->with('success', 'Solicitud de vacaciones rechazada');
}
}