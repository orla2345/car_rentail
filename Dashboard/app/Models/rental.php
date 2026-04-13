<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rental extends Model
{
    protected $table = 'rentals';
    protected $primaryKey = 'id';
    
    // CORREGIDO: Coincide al 100% con tu migración
    protected $fillable = [
        'user_id',
        'car_id',
        'driver_id', // <-- Cambiado a singular
        'pickup_date',
        'return_date',
        'total_amount',
        'status',    // <-- Agregado para que puedas guardar el estado de la renta
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(car::class);    
    }

    public function driver()
    {
        // Al llamarse driver_id, Laravel lo entiende automático
        return $this->belongsTo(driver::class);
    }
}