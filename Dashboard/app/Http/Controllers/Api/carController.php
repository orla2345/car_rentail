<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\car; // Importamos tu modelo de carros

class CarController extends Controller
{
    /**
     * GET /api/cars
     */
    public function index()
    {
        // Traemos todos los carros y de paso incluimos la info de su marca (relación)
        $cars = car::with('brand')->get();
        
        return response()->json([
            'success' => true,
            'data' => $cars
        ], 200);
    }

    /**
     * POST /api/cars
     */
    public function store(Request $request)
    {
        // 1. Validamos todos los campos que pusiste en tu migración
        $validatedData = $request->validate([
            'brand_id'      => 'required|exists:brands,id', // Verifica que la marca exista
            'model'         => 'required|string|max:255',
            'year'          => 'required|integer',
            'color'         => 'required|string|max:255',
            'license_plate' => 'required|string|max:255|unique:cars,license_plate', // Que no se repitan placas
            'mileage'       => 'required|integer',
            'lat'           => 'required|numeric',
            'lng'           => 'required|numeric',
            'is_premium'    => 'required|integer',
            'rental_count'  => 'required|integer',
            'daily_rate'    => 'required|integer',
            'status'        => 'required|in:available,rented,maintenance,retired',
        ]);

        // 2. Creamos el carro
        $car = car::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Carro registrado exitosamente',
            'data' => $car
        ], 201);
    }

    /**
     * GET /api/cars/{id}
     */
    public function show(string $id)
    {
        // Buscamos el carro por ID y traemos su marca
        $car = car::with('brand')->find($id);

        if (!$car) {
            return response()->json([
                'success' => false,
                'message' => 'Carro no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $car
        ], 200);
    }

    /**
     * PUT/PATCH /api/cars/{id}
     */
    public function update(Request $request, string $id)
    {
        $car = car::find($id);

        if (!$car) {
            return response()->json([
                'success' => false,
                'message' => 'Carro no encontrado para actualizar'
            ], 404);
        }

        $validatedData = $request->validate([
            'brand_id'      => 'sometimes|required|exists:brands,id',
            'model'         => 'sometimes|required|string|max:255',
            'year'          => 'sometimes|required|integer',
            'color'         => 'sometimes|required|string|max:255',
            'license_plate' => 'sometimes|required|string|max:255|unique:cars,license_plate,'.$id,
            'mileage'       => 'sometimes|required|integer',
            'lat'           => 'sometimes|required|numeric',
            'lng'           => 'sometimes|required|numeric',
            'is_premium'    => 'sometimes|required|integer',
            'rental_count'  => 'sometimes|required|integer',
            'daily_rate'    => 'sometimes|required|integer',
            'status'        => 'sometimes|required|in:available,rented,maintenance,retired',
        ]);

        $car->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Carro actualizado correctamente',
            'data' => $car
        ], 200);
    }

    /**
     * DELETE /api/cars/{id}
     */
    public function destroy(string $id)
    {
        $car = car::find($id);

        if (!$car) {
            return response()->json([
                'success' => false,
                'message' => 'Carro no encontrado para eliminar'
            ], 404);
        }

        $car->delete();

        return response()->json([
            'success' => true,
            'message' => 'Carro eliminado correctamente'
        ], 200);
    }
}