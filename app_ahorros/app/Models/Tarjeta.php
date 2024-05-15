<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    use HasFactory;

    protected $table = 'tarjetas';
    /**
     * The attributes that are mass assignable.
     *
    // //  * @var array<int, string>
     */
    protected $fillable = [
        'numero',
        'id_tipo_tarjeta',
        'id_asociacion_tarjeta',
        'cuota_manejo',
        'fecha_cuota_manejo',
        'nombre_banco',
        'id_usuario',
        'id_estado',
    ];
}
