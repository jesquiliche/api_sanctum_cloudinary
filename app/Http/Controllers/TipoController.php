<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipos = Tipo::all();
        return response()->json($tipos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $tipo = Tipo::create($validator->validated());

        return response()->json($tipo, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tipo = Tipo::findOrFail($id);
        return response()->json($tipo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $tipo = Tipo::find($id);
        if ($tipo) {
            $tipo->update($request->all());
            return response()->json($tipo);
        } else {
            return response()->json(['message' => 'Tipo no encontrada'], 404);
        }

    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tipo = Tipo::find($id);
        if($tipo){
            $tipo->delete();
            return response()->json(null, 204);
        }
        return response()->json(null, 404);
    }
}
