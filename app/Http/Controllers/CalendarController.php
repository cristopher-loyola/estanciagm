<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar'); // Asegúrate de que existe 'resources/views/calendar.blade.php'
    }
}
