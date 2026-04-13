<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class driver extends Model
{
    use HasFactory;

    protected $table = 'drivers';

    protected $primaryKey = 'id';

    /**
     * Los atributos que se pueden asignar masivamente.
     * Se cambió 'users_id' por 'user_id' para coincidir con la migración.
     */
    protected $fillable = [
        'user_id',
        'license_number',
        'license_img',
    ];

    /**
     * Obtener el usuario al que pertenece el chofer.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}