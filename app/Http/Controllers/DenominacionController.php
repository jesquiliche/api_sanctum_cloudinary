<?php

namespace App\Http\Controllers;

use App\Models\Denominacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DenominacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $denominaciones = Denominacion::all();
        return response()->json($denominaciones);
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

        $denominacion = Denominacion::create($validator->validated());

        return response()->json($denominacion, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $denominacion = Denominacion::findOrFail($id);
        return response()->json($denominacion);
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

        $denominacion = Denominacion::find($id);
        if ($denominacion) {
            $denominacion->update($request->all());
            return response()->json($denominacion);
        } else {
            return response()->json(['message' => 'Denominación no encontrada'], 404);
        }
        return response()->json($denominacion);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $denominacion = Denominacion::findOrFail($id);
        $denominacion->delete();

        return response()->json(null, 204);
    }
}
