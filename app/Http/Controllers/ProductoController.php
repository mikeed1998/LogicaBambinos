<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Categoria;

class ProductoController extends Controller
{
    public function index() {
        return redirect()->route('productos.index'); // redirige a la seccion
    }

    public function create() {
        $categorias = Categoria::all();
        return view('config.secciones.producto.create', compact('categorias'));
    }

    public function store(Request $request) {
        dd($request);
    }

    public function show(Producto $producto) {
        return view('config.secciones.producto.show', compact('producto'));
    }

    public function edit(Producto $producto) {
        // Se hace con AJAX en show
    }

    public function update(Request $request, Producto $producto) {
        // Se hace con AJAX en show
    }

    public function destroy(Producto $producto) {
        // En show solo se deshabilita, falta planificar si habrá eliminación
    }
}
