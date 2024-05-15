<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gasto_y_ingreso extends Model
{
    use HasFactory;

    protected $table = 'gastos_y_ingresos';
    /**
     * The attributes that are mass assignable.
     *
    // //  * @var array<int, string>
     */
    protected $fillable = [
        'detalle',
        'valor',
        'fecha',
        'id_tipo_periodo',
        'id_tipo_dinero',
        'id_tarjeta',
        'id_estado',
    ];
}
