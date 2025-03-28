<?php

namespace App\Http\Controllers;

use App\Models\Vacation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Añade esta línea


class VacationController extends Controller

{
    public function index()
    {
        $vacations = Auth::user()->vacations()->orderBy('start_date', 'desc')->get();
        return view('calendar', compact('vacations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);

        Vacation::create([
            'user_id' => Auth::id(), // Usando el facade Auth
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'pendiente'
        ]);

        return back()->with('success', 'Solicitud creada');
    }

    public function destroy(Vacation $vacation)
    {
        $vacation->delete();
        return back()->with('success', 'Solicitud eliminada');
    }
   
    public function approve($id)
    {
        $vacation = Vacation::findOrFail($id);
        $vacation->status = 'aprobado';
        $vacation->save();
        
        // Notificación simple (solo database)
        $vacation->user->notify(new \App\Notifications\VacationStatusNotification('aprobado'));
        
        return back()->with('success', 'Vacaciones aprobadas');
    }
    
    public function reject($id)
    {
        $vacation = Vacation::findOrFail($id);
        $vacation->status = 'rechazado';
        $vacation->save();
        
        // Notificación simple (solo database)
        $vacation->user->notify(new \App\Notifications\VacationStatusNotification('rechazado'));
        
        return back()->with('success', 'Vacaciones rechazadas');
    }



  
}