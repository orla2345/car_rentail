<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rental; // <-- Importamos tu modelo

class RentalController extends Controller
{
    /**
     * GET /api/rentals
     */
    public function index()
    {
        // Traemos todas las rentas con los datos del usuario, el carro y el chofer
        $rentals = rental::with(['user', 'car', 'driver'])->get();
        
        return response()->json([
            'success' => true,
            'data' => $rentals
        ], 200);
    }

    /**
     * POST /api/rentals
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id'      => 'required|exists:users,id',
            'car_id'       => 'required|exists:cars,id',
            'driver_id'    => 'required|exists:drivers,id',
            'pickup_date'  => 'required|date',
            'return_date'  => 'required|date|after_or_equal:pickup_date', // Valida que no lo devuelva antes de llevárselo
            'total_amount' => 'required|numeric',
            'status'       => 'required|in:pending,confirmed,active,completed,canceled',
        ]);

        $rental = rental::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Renta registrada exitosamente',
            'data' => $rental
        ], 201);
    }

    /**
     * GET /api/rentals/{id}
     */
    public function show(string $id)
    {
        $rental = rental::with(['user', 'car', 'driver'])->find($id);

        if (!$rental) {
            return response()->json([
                'success' => false,
                'message' => 'Renta no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $rental
        ], 200);
    }

    /**
     * PUT/PATCH /api/rentals/{id}
     */
    public function update(Request $request, string $id)
    {
        $rental = rental::find($id);

        if (!$rental) {
            return response()->json([
                'success' => false,
                'message' => 'Renta no encontrada para actualizar'
            ], 404);
        }

        $validatedData = $request->validate([
            'user_id'      => 'sometimes|required|exists:users,id',
            'car_id'       => 'sometimes|required|exists:cars,id',
            'driver_id'    => 'sometimes|required|exists:drivers,id',
            'pickup_date'  => 'sometimes|required|date',
            'return_date'  => 'sometimes|required|date|after_or_equal:pickup_date',
            'total_amount' => 'sometimes|required|numeric',
            'status'       => 'sometimes|required|in:pending,confirmed,active,completed,canceled',
        ]);

        $rental->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Renta actualizada correctamente',
            'data' => $rental
        ], 200);
    }

    /**
     * DELETE /api/rentals/{id}
     */
    public function destroy(string $id)
    {
        $rental = rental::find($id);

        if (!$rental) {
            return response()->json([
                'success' => false,
                'message' => 'Renta no encontrada para eliminar'
            ], 404);
        }

        $rental->delete();

        return response()->json([
            'success' => true,
            'message' => 'Renta eliminada correctamente'
        ], 200);
    }
}