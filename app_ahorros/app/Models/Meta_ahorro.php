<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meta_ahorro extends Model
{
    use HasFactory;
    protected $table = 'metas_ahorros';
    /**
     * The attributes that are mass assignable.
     *
    // //  * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'valor',
        'fecha_inicio',
        'fecha_final',
        'id_usuario',
        'id_estado',
    ];
}
