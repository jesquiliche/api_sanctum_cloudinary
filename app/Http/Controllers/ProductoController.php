<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $productos = Producto::all();
        return response()->json($productos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'bodega' => 'nullable|string|max:255',
            'descripcion' => 'required|string',
            'maridaje' => 'required|string',
            'precio' => 'required|numeric',
            'graduacion' => 'required|numeric',
            'ano' => 'nullable|integer',
            'sabor' => 'nullable|string|max:255',
            'tipo_id' => 'required|exists:tipos,id',
            'imagen' => 'nullable|string',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'denominacion_id' => 'required|exists:denominaciones,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Procesar y guardar la imagen en Cloudinary
        if ($request->hasFile('file')) {
            $uploadedFileUrl = Cloudinary::upload($request->file('file')->getRealPath())->getSecurePath();
        }

        $producto = Producto::create([
            'nombre' => $request->nombre,
            'bodega' => $request->bodega,
            'descripcion' => $request->descripcion,
            'maridaje' => $request->maridaje,
            'precio' => $request->precio,
            'graduacion' => $request->graduacion,
            'ano' => $request->ano,
            'sabor' => $request->sabor,
            'tipo_id' => $request->tipo_id,
            'imagen' => $uploadedFileUrl ?? null,
            'denominacion_id' => $request->denominacion_id,
        ]);

        return response()->json($producto, 201); // 201 Created
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(["mensaje" => "Producto no encontrado"], 404);
        }
        return response()->json($producto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Obtener el producto por su ID

        // Validar los datos recibidos en la solicitud
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'bodega' => 'nullable|string|max:255',
            'descripcion' => 'required|string',
            'maridaje' => 'required|string',
            'precio' => 'required|numeric',
            'graduacion' => 'required|numeric',
            'ano' => 'nullable|integer',
            'sabor' => 'nullable|string|max:255',
            'tipo_id' => 'required|exists:tipos,id',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'denominacion_id' => 'required|exists:denominaciones,id',
        ]);

        // Si la validación falla, retornar los errores en formato JSON
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(["mensaje" => "Producto no encontrado"], 404);
        }

        // Procesar y guardar la nueva imagen si se ha cargado
        if ($request->hasFile('file')) {
            // Eliminar la imagen antigua si existe
            if ($producto->imagen) {
                // Nota: No se puede eliminar directamente de Cloudinary con el SDK sin conocer el public_id
                // Por lo que en este ejemplo no se eliminan imágenes antiguas.
            }

            // Guardar la nueva imagen en Cloudinary
            $uploadedFileUrl = Cloudinary::upload($request->file('file')->getRealPath())->getSecurePath();
            $producto->imagen = $uploadedFileUrl;
        }

        // Actualizar el producto con los datos validados
        $producto->update($request->all());

        // Retornar el producto actualizado en formato JSON
        return response()->json($producto);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        // Nota: No se puede eliminar directamente de Cloudinary con el SDK sin conocer el public_id
        // Por lo que en este ejemplo no se eliminan imágenes de Cloudinary.
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(["mensaje" => "Producto no encontrado"], 404);
        }
        $producto->delete();

        return response()->json(null, 204); // 204 No Content
    }
}
