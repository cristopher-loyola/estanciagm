<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacation;

class CalendarController extends Controller
{
    public function index()
    {
        // Obtener las vacaciones del usuario autenticado
        $vacations = auth()->user()->vacations()
                        ->orderBy('start_date', 'desc')
                        ->get();
        
        return view('calendar', [
            'vacations' => $vacations,
            // Mantén otros datos que ya estabas pasando
            'highlight_start' => request('highlight_start'),
            'highlight_end' => request('highlight_end')
        ]);
    }
}