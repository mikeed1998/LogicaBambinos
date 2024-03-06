<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\User;

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

        // Validación y sanitización aquí

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

}
