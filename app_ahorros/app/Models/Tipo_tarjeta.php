<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_tarjeta extends Model
{
    use HasFactory;

    protected $table = 'tipos_tarjetas';
    /**
     * The attributes that are mass assignable.
     *
    // //  * @var array<int, string>
     */
    protected $fillable = [
        'tipo',

    ];
}
