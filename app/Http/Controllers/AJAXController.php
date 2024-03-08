<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\User;
use App\Producto;

class AJAXController extends Controller
{
    public function editarajax(Request $request)
    {
        $modelName = $request->input('modelo');
        $id = $request->input('id');

        $modelPath = "\\App\\" . $modelName;

        if (!class_exists($modelPath)) {
            return response()->json(['error' => 'Modelo no encontrado'], 404);
        }

        try {
            $model = $modelPath::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        $field = $request->input('field');
        $value = $request->input('value');

        // Validación y sanitización

        $model->$field = $value;
        $model->save();

        return response()->json(['success' => 'Actualizado correctamente']);
    }

    public function cambiar_imagen(Request $request) {

        if($request->tipo_imagen == 'perfil_usuario') {
            $isDefault = 0;
            $usuario = User::find($request->id_imagen);
            $file_usuario = $request->file('archivo');
            $oldFileUsuario = 'img/photos/usuarios/'.$usuario->imagen;
            if ($usuario->imagen == 'default.png') $isDefault = 1;
            $extension_usuario = $file_usuario->getClientOriginalExtension();
            $namefile_usuario = Str::random(30) . '.' . $extension_usuario;

            \Storage::disk('local')->put("img/photos/usuarios/" . $namefile_usuario, \File::get($file_usuario));

            if (!$isDefault)
                unlink($oldFileUsuario);

            $usuario->imagen = $namefile_usuario;
            $usuario->update();

            \Toastr::success('Guardado');
            return redirect()->back();
        } else {
            dd('no llego');
        }
    }

    public function switch_inicio(Request $request){
        $producto = Producto::find($request->id);
        $producto_des = Producto::where('inicio',1)->count();

        if($producto_des == 4)
            if($request->valor == 'true')
                return response()->json(['success'=>false, 'mensaje'=>'No puedes agregar mas de 4 productos destacados']);

        if($request->valor == 1) {
            $producto->inicio = 1;
            if($producto->save())
                return response()->json(['success'=>true, 'mensaje'=>'Se agrego a destacados']);
            else
                return response()->json(['success'=>false, 'mensaje'=>'Error al agregar']);
        } else {
            $producto->inicio = 0;
            if($producto->save())
                return response()->json(['success'=>true, 'mensaje'=>'Se removio de destacados']);
            else
                return response()->json(['success'=>false, 'mensaje'=>'Error al remover']);
        }
    }

    public function switch_ocultar(Request $request){
        $producto = Producto::find($request->id);
        $producto_des = Producto::where('visible',1)->count();

        if($request->valor == 1) {
            $producto->visible = 1;
            if($producto->save())
                return response()->json(['success'=>true, 'mensaje'=>'Vuelve a ser visible en la tienda']);
            else
                return response()->json(['success'=>false, 'mensaje'=>'Error al mostrar']);
        } else {
            $producto->visible = 0;
            if($producto->save())
                return response()->json(['success'=>true, 'mensaje'=>'Se ha ocultado de la tienda']);
            else
                return response()->json(['success'=>false, 'mensaje'=>'Error al ocultar']);
        }
    }

    public function switch_eliminar(Request $request){
        $producto = Producto::find($request->id);
        $producto_des = Producto::where('activo',1)->count();

        if($request->valor == 1) {
            $producto->activo = 1;
            if($producto->save())
                return response()->json(['success'=>true, 'mensaje'=>'Se ha deshabilitado de la tienda']);
            else
                return response()->json(['success'=>false, 'mensaje'=>'Error al remover']);
        } else {
            $producto->activo = 0;
            if($producto->save())
                return response()->json(['success'=>true, 'mensaje'=>'Ha sido habilitado']);
            else
                return response()->json(['success'=>false, 'mensaje'=>'Error al habilitar']);
        }
    }

}




