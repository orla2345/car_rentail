<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\driver; // <-- Importamos tu modelo

class DriverController extends Controller
{
    /**
     * GET /api/drivers
     */
    public function index()
    {
        // Traemos todos los choferes y su información de usuario vinculada
        $drivers = driver::with('user')->get();
        
        return response()->json([
            'success' => true,
            'data' => $drivers
        ], 200);
    }

    /**
     * POST /api/drivers
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id'        => 'required|exists:users,id', // Verifica que el usuario exista
            'license_number' => 'required|string|max:255|unique:drivers,license_number', // Que no haya licencias duplicadas
            'license_img'    => 'required|string|max:255',
        ]);

        $driver = driver::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Chofer registrado exitosamente',
            'data' => $driver
        ], 201);
    }

    /**
     * GET /api/drivers/{id}
     */
    public function show(string $id)
    {
        $driver = driver::with('user')->find($id);

        if (!$driver) {
            return response()->json([
                'success' => false,
                'message' => 'Chofer no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $driver
        ], 200);
    }

    /**
     * PUT/PATCH /api/drivers/{id}
     */
    public function update(Request $request, string $id)
    {
        $driver = driver::find($id);

        if (!$driver) {
            return response()->json([
                'success' => false,
                'message' => 'Chofer no encontrado para actualizar'
            ], 404);
        }

        $validatedData = $request->validate([
            'user_id'        => 'sometimes|required|exists:users,id',
            'license_number' => 'sometimes|required|string|max:255|unique:drivers,license_number,'.$id,
            'license_img'    => 'sometimes|required|string|max:255',
        ]);

        $driver->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Datos del chofer actualizados correctamente',
            'data' => $driver
        ], 200);
    }

    /**
     * DELETE /api/drivers/{id}
     */
    public function destroy(string $id)
    {
        $driver = driver::find($id);

        if (!$driver) {
            return response()->json([
                'success' => false,
                'message' => 'Chofer no encontrado para eliminar'
            ], 404);
        }

        $driver->delete();

        return response()->json([
            'success' => true,
            'message' => 'Chofer eliminado correctamente'
        ], 200);
    }
}