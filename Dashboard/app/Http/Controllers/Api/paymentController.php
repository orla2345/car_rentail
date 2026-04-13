<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\payment; // <-- Importamos tu modelo

class PaymentController extends Controller
{
    /**
     * GET /api/payments
     */
    public function index()
    {
        // Traemos todos los pagos junto con la información de la renta
        $payments = payment::with('rental')->get();
        
        return response()->json([
            'success' => true,
            'data' => $payments
        ], 200);
    }

    /**
     * POST /api/payments
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'rental_id'      => 'required|exists:rentals,id', // Verifica que la renta exista
            'amount'         => 'required|numeric', // numeric acepta decimales
            'payment_method' => 'required|string|max:255',
            'transaction_id' => 'required|string|max:255|unique:payments,transaction_id', // Que no se repita el folio
            'status'         => 'required|in:pending,completed,failed,refunded', // Solo acepta lo de tu Enum
        ]);

        $payment = payment::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Pago registrado exitosamente',
            'data' => $payment
        ], 201);
    }

    /**
     * GET /api/payments/{id}
     */
    public function show(string $id)
    {
        $payment = payment::with('rental')->find($id);

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Pago no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $payment
        ], 200);
    }

    /**
     * PUT/PATCH /api/payments/{id}
     */
    public function update(Request $request, string $id)
    {
        $payment = payment::find($id);

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Pago no encontrado para actualizar'
            ], 404);
        }

        $validatedData = $request->validate([
            'rental_id'      => 'sometimes|required|exists:rentals,id',
            'amount'         => 'sometimes|required|numeric',
            'payment_method' => 'sometimes|required|string|max:255',
            'transaction_id' => 'sometimes|required|string|max:255|unique:payments,transaction_id,'.$id,
            'status'         => 'sometimes|required|in:pending,completed,failed,refunded',
        ]);

        $payment->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Pago actualizado correctamente',
            'data' => $payment
        ], 200);
    }

    /**
     * DELETE /api/payments/{id}
     */
    public function destroy(string $id)
    {
        $payment = payment::find($id);

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Pago no encontrado para eliminar'
            ], 404);
        }

        $payment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pago eliminado correctamente'
        ], 200);
    }
}