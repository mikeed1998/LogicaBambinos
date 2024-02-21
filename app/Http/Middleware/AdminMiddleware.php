<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if(Auth::check())
        {
            if(Auth::user()->role_as == '1')
            {
                return $next($request);
            }
            else
            {
                return redirect('/')->with('status', '¡Acceso denegado! no tienes permisos de administrador');
            }
        }
        else
        {
            return redirect('/')->with('status', 'Inicia sesión primero');
        }
    }
}
