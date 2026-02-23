<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'id';
    protected $fillable = [
        'rental_id',
        'amount',
        'payment_date',
        'payment_method',
    ];
}
