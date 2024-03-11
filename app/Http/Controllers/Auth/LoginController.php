<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\CarritoPersistente;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    protected function authenticated(Request $request)
    {
        // dd($request);
        if(Auth::user()->role_as == '1')    // Administrador general
        {
            if ($request->from == 0) {
                Auth::logout();
                \Toastr::error('Esta no es la ruta para acceder al administrador');
                return redirect('/');
            } else {
                \Toastr::success('Has iniciado sesión como administrador');
                return redirect('/homeA');
            }
        }
        elseif(Auth::user()->role_as == '2')    // Vendedor
        {
            \Toastr::success('Has iniciado sesión con privilegios de vendedor');
            return redirect('/homeV');
        }
        elseif(Auth::user()->role_as == '0')    // Usuario normal
        {
            // dd(Auth::user());
            // recuperar carrito persistente para el usuario que esta iniciando sesión
            $carritoPersistente = CarritoPersistente::where('usuario', Auth::id())->first();
            // dd($carritoPersistente);

            if ($carritoPersistente) {
                // Si existe el carrito persistente, inicializar la sesión del carrito con esos valores
                $cart = json_decode($carritoPersistente->carrito, true);
                // dd($cart);
            } else {
                // Si no existe carrito persistente, inicializar la sesión del carrito como vacía
                $cart = [];
            }

            // Inicializar la sesión del carrito con los valores obtenidos
            session()->put('cart', $cart);

            \Toastr::success('Has iniciado sesión');
            return redirect('/home');
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout()
    {
        Auth::logout(); // Cerrar la sesión del usuario
        Session::forget('cart'); // Limpiar la sesión del carrito
        Session::forget('cartTotal');
        Session::forget('cartTotalUnits');
        Session::forget('cartID');
        \Toastr::success('Has salido de tu cuenta');
        return redirect('/'); // Redirigir a la página de inicio de sesión u otra página según tus necesidades
    }
}
