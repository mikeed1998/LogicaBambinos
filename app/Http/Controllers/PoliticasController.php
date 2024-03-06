<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Politica;

class PoliticasController extends Controller
{
    public function index() {
        $politicas = Politica::all();
        return view('config.polititcas.index', compact('politicas'));
    }

    public function create() {

    }

    public function store(Request $request) {
        //
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $politica = Politica::find($id);
        return view('config.polititcas.edit', compact('politica'));
    }

    public function update(Request $request, $id) {
        $politica = Politica::find($id);
        $politica->descripcion = $request->descripcion;
        $politica->update();
        return redirect()->back();
    }

    public function destroy($id) {
        //
    }
}
