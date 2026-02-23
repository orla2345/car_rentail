<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class car extends Model
{
    protected $table = 'cars';
    protected $primaryKey = 'id';
    protected $fillable = [
        'model',
        'year',
        'license_plate',
        'rental_price_per_day',
        'brand_id',
        'mileage',
        'lat',
        'lng',
        'is_premium',
        'rental_count',
        'daily_rate',
        'status',
    ];
}
