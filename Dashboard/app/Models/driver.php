<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class driver extends Model
{
    protected $table = 'drivers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'license_number',
        'users_id',
        'license_img',
    ];
}
