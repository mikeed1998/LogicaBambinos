<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PasarelaPagoMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role_as == '0') {
            return $next($request);
        }

        return redirect('/login')->with('status', '¡Acceso denegado! Tienes que iniciar sesión');
    }
}
