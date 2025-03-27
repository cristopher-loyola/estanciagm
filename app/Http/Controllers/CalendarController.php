<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon; // Añadir esta línea

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $highlight = [];
        
        if ($request->has('highlight_start') && $request->has('highlight_end')) {
            try {
                $highlight = [
                    'start' => Carbon::parse($request->highlight_start),
                    'end' => Carbon::parse($request->highlight_end)
                ];
            } catch (\Exception $e) {
                // Opcional: registrar el error
                \Log::error('Error parsing dates: ' . $e->getMessage());
            }
        }
    
        return view('calendar', compact('highlight'));
    }
}