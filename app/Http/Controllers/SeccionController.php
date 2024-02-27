<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seccion;
use App\Elemento;
use App\Configuracion;

class SeccionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $seccion = Seccion::all();

        // foreach ($seccion as $sec) {
        //     $sec->elements = $sec->elementos()->count();
        // }

        return view('config.secciones.index',compact('seccion'));
    }

    public function show($seccion) {
        $config = Configuracion::all();
        $seccion_nom = $seccion;

		$seccion = Seccion::where('slug',$seccion)->first();

        $elementos = Elemento::where('seccion',$seccion->id)->get();

        $elem_general = Elemento::all();

		// $elements = $seccion->elementos()->get();

        $ruta = 'config.secciones.'.$seccion->seccion;

		return view($ruta, compact('seccion', 'config', 'elem_general'));
    }

    public function contacto() {
        $config = Configuracion::find(1);

		return view('config.general.contacto', compact('config'));
    }

    public function textglobalseccion(Request $request){
        if (empty($request->tabla)) {
            return response()->json(['success'=>false, 'mensaje'=>'Cambio Exitoso']);
        }

        $nameSpace = '\\App\\';
        $model = $nameSpace . ucfirst($request->tabla);

        $field = $request->campo;
        $val = $request->valor;

        $send = $model::find($request->id);
        $send->$field = $val;

        if ($send->save()) {
            if(isset($request->form)){
                \Toastr::success('Guardado');
                return redirect()->back();
            }else{
                return response()->json(['success'=>true, 'mensaje'=>'Cambio Exitoso']);
            }

        }else {
            if(isset($request->form)){
                \Toastr::error('Error al guardar');
                return redirect()->back();
            }else{
            return response()->json(['success'=>false, 'mensaje'=>'Error al actualizar']);
            }
        }
    }

}
