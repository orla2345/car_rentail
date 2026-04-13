<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // <-- Importamos tu modelo (Laravel lo trae por defecto con U mayúscula)

class UserController extends Controller
{
    /**
     * GET /api/users
     */
    public function index()
    {
        // Traemos todos los usuarios y su nivel de lealtad
        $users = User::with('loyaltyLevel')->get();
        
        return response()->json([
            'success' => true,
            'data' => $users
        ], 200);
    }

    /**
     * POST /api/users
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|string|email|max:255|unique:users,email', // Valida formato de email y que no se repita
            'password'         => 'required|string|min:8', // Mínimo 8 caracteres por seguridad
            'img'              => 'required|string|max:255',
            'loyalty_level_id' => 'required|exists:loyalty_levels,id', // El nivel debe existir en la BD
        ]);

        // La contraseña se encripta automáticamente gracias al "cast" en tu modelo User
        $user = User::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Usuario registrado exitosamente',
            'data' => $user
        ], 201);
    }

    /**
     * GET /api/users/{id}
     */
    public function show(string $id)
    {
        $user = User::with('loyaltyLevel')->find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }

    /**
     * PUT/PATCH /api/users/{id}
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado para actualizar'
            ], 404);
        }

        $validatedData = $request->validate([
            'name'             => 'sometimes|required|string|max:255',
            // Ojo aquí: Le decimos que el email debe ser único, EXCEPTO si es el email del usuario actual ($id)
            'email'            => 'sometimes|required|string|email|max:255|unique:users,email,'.$id,
            'password'         => 'sometimes|required|string|min:8',
            'img'              => 'sometimes|required|string|max:255',
            'loyalty_level_id' => 'sometimes|required|exists:loyalty_levels,id',
        ]);

        $user->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Usuario actualizado correctamente',
            'data' => $user
        ], 200);
    }

    /**
     * DELETE /api/users/{id}
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado para eliminar'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Usuario eliminado correctamente'
        ], 200);
    }
}