<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'id';
    
    // CORREGIDO: Ahora coincide exactamente con tu migración
    protected $fillable = [
        'rental_id',
        'amount',
        'payment_method',
        'transaction_id',
        'status',
    ];

    public function rental()
    {
        return $this->belongsTo(rental::class);
    }
}