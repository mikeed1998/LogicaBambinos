<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\ProductoGaleria;

class ProductoGaleriaController extends Controller
{
    public function index() {
        //
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        $galeria = new ProductoGaleria;
        $file_galeria = $request->file('archivo');

        $extension_galeria = $file_galeria->getClientOriginalExtension();
        $namefile_galeria = Str::random(30) . '.' . $extension_galeria;

        \Storage::disk('local')->put("img/productos/galeria/" . $namefile_galeria, \File::get($file_galeria));

        $galeria->producto = $request->id_producto;
        $galeria->imagen = $namefile_galeria;
        $galeria->save();

        \Toastr::success('Imágen añadida');
        return redirect()->back();
    }

    public function show(ProductoGaleria $galeria) {
        //
    }

    public function edit(ProductoGaleria $galeria) {
        // Se hace con AJAX en show
    }

    public function update(Request $request, ProductoGaleria $galeria) {
        // Se hace con AJAX en show
    }

    public function destroy($id) {
        $galeria = ProductoGaleria::find($id);

        if (!$galeria) {
            return response()->json(['error' => 'Imagen no encontrada'], 404);
        }

        $img = 'img/productos/galeria' . $galeria->imagen;
        unlink($img);
        $galeria->delete();

        return response()->json(['success' => 'Imágen eliminada']);
    }
}
