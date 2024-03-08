<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\ProductoGaleria;
use App\ProductoCaracteristica;
use App\Categoria;
use Illuminate\Validation\ValidationException;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $producto = new Producto;

        $producto->categoria = $request->categoria;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->frente = $request->frente;
        $producto->fondo = $request->fondo;
        $producto->alto = $request->alto;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;

        if(!$request->promocion) {
            $producto->promocion = 0.00;
        } else {
            $producto->promocion = $request->promocion;
        }

        $producto->activo = 0;
        $producto->visible = 0;
        $producto->inicio = 0;

        $file = $request->file('portada');
        $extension = $file->getClientOriginalExtension();
        $namefile = Str::random(30) . '.' . $extension;

        \Storage::disk('local')->put("/img/productos/" . $namefile, \File::get($file));

        $producto->portada = $namefile;

        $producto->save();

        $idProducto = $producto->id;
        $caracteristicas = $request->input('caracteristica', []);

        foreach ($caracteristicas as $caracteristica) {
            $caracte = new ProductoCaracteristica;
            $caracte->producto = $idProducto;
            $caracte->caracteristica = $caracteristica;
            $caracte->save();
        }

        Toastr::success('Producto creado');
        return redirect()->route('seccion.show', ['slug' => 'catalogo']);
    }

    public function show(Producto $producto) {
        $galeria = ProductoGaleria::where('producto', $producto->id)->get();
        return view('config.secciones.producto.show', compact('producto', 'galeria'));
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
