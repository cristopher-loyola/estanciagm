<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin // <- Asegúrate de que el nombre de la clase es IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'Acceso no autorizado');
        }

        return $next($request);
    }
}
