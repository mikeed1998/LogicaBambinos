<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminAccess
{
    public function handle($request, Closure $next)
    {
        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            // Si el usuario está autenticado, redirigirlo a otra ruta
            return redirect('/homeA');
        }

        // Si el usuario no está autenticado, continuar con la solicitud
        return $next($request);
    }
}
