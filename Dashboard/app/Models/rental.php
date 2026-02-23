<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rental extends Model
{
    protected $table = 'rentals';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'car_id',
        'drivers_id',
        'pickup_date',
        'return_date',
        'total_amount',
    ];
}
