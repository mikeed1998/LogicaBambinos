<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

}
