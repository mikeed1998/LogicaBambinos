<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CartAccessMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role_as == '0') {
            return $next($request);
        }

        session()->put('cartTotal', 0);
        session()->put('cartTotalUnits', 0);
        session()->put('cartIVA', 0);
        session()->put('cartTotalGNRL', 0);
        session()->put('cartEnvio', 0);

        return redirect('/login')->with('status', '¡Acceso denegado! Tienes que iniciar sesión');
    }
}
