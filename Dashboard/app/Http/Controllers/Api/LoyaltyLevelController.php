<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\loyalty_level; // <-- Importamos tu modelo

class LoyaltyLevelController extends Controller
{
    /**
     * GET /api/loyalty_levels
     */
    public function index()
    {
        // Traemos todos los niveles de lealtad
        $loyaltyLevels = loyalty_level::all();
        
        return response()->json([
            'success' => true,
            'data' => $loyaltyLevels
        ], 200);
    }

    /**
     * POST /api/loyalty_levels
     */
    public function store(Request $request)
    {
        // Validamos los datos asegurando que todos sean del tipo correcto
        $validatedData = $request->validate([
            'name'                => 'required|string|max:255',
            'min_points'          => 'required|integer',
            'discount_percentage' => 'required|integer',
            'free_extra_hours'    => 'required|integer',
        ]);

        // Creamos el nivel en la base de datos
        $loyaltyLevel = loyalty_level::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Nivel de lealtad creado exitosamente',
            'data' => $loyaltyLevel
        ], 201);
    }

    /**
     * GET /api/loyalty_levels/{id}
     */
    public function show(string $id)
    {
        $loyaltyLevel = loyalty_level::find($id);

        if (!$loyaltyLevel) {
            return response()->json([
                'success' => false,
                'message' => 'Nivel de lealtad no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $loyaltyLevel
        ], 200);
    }

    /**
     * PUT/PATCH /api/loyalty_levels/{id}
     */
    public function update(Request $request, string $id)
    {
        $loyaltyLevel = loyalty_level::find($id);

        if (!$loyaltyLevel) {
            return response()->json([
                'success' => false,
                'message' => 'Nivel de lealtad no encontrado para actualizar'
            ], 404);
        }

        // Usamos 'sometimes' porque al actualizar podrías enviar solo un campo
        $validatedData = $request->validate([
            'name'                => 'sometimes|required|string|max:255',
            'min_points'          => 'sometimes|required|integer',
            'discount_percentage' => 'sometimes|required|integer',
            'free_extra_hours'    => 'sometimes|required|integer',
        ]);

        $loyaltyLevel->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Nivel de lealtad actualizado correctamente',
            'data' => $loyaltyLevel
        ], 200);
    }

    /**
     * DELETE /api/loyalty_levels/{id}
     */
    public function destroy(string $id)
    {
        $loyaltyLevel = loyalty_level::find($id);

        if (!$loyaltyLevel) {
            return response()->json([
                'success' => false,
                'message' => 'Nivel de lealtad no encontrado para eliminar'
            ], 404);
        }

        $loyaltyLevel->delete();

        return response()->json([
            'success' => true,
            'message' => 'Nivel de lealtad eliminado correctamente'
        ], 200);
    }
}