<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    protected $table = 'brands';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'img',
    ];
}
