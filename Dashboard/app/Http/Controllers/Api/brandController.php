<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\brand; // <- IMPORTANTE: Importamos tu modelo

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /api/brands
     */
    public function index()
    {
        // Traemos todas las marcas de la base de datos
        $brands = brand::all();
        
        // Devolvemos la respuesta en formato JSON con un código HTTP 200 (OK)
        return response()->json([
            'success' => true,
            'data' => $brands
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     * POST /api/brands
     */
    public function store(Request $request)
    {
        // 1. Validamos que los datos que envían sean correctos
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'img'  => 'required|string|max:255',
        ]);

        // 2. Creamos la nueva marca en la base de datos
        $brand = brand::create($validatedData);

        // 3. Devolvemos la marca recién creada con código 201 (Created)
        return response()->json([
            'success' => true,
            'message' => 'Marca creada exitosamente',
            'data' => $brand
        ], 201);
    }

    /**
     * Display the specified resource.
     * GET /api/brands/{id}
     */
    public function show(string $id)
    {
        // Buscamos la marca por su ID
        $brand = brand::find($id);

        // Si no existe, devolvemos un error 404 (Not Found)
        if (!$brand) {
            return response()->json([
                'success' => false,
                'message' => 'Marca no encontrada'
            ], 404);
        }

        // Si existe, la devolvemos
        return response()->json([
            'success' => true,
            'data' => $brand
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     * PUT/PATCH /api/brands/{id}
     */
    public function update(Request $request, string $id)
    {
        // Buscamos la marca por su ID
        $brand = brand::find($id);

        if (!$brand) {
            return response()->json([
                'success' => false,
                'message' => 'Marca no encontrada para actualizar'
            ], 404);
        }

        // Validamos los datos (pueden ser opcionales al actualizar)
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'img'  => 'sometimes|required|string|max:255',
        ]);

        // Actualizamos la marca
        $brand->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Marca actualizada correctamente',
            'data' => $brand
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /api/brands/{id}
     */
    public function destroy(string $id)
    {
        $brand = brand::find($id);

        if (!$brand) {
            return response()->json([
                'success' => false,
                'message' => 'Marca no encontrada para eliminar'
            ], 404);
        }

        // Eliminamos la marca
        $brand->delete();

        return response()->json([
            'success' => true,
            'message' => 'Marca eliminada correctamente'
        ], 200);
    }
}