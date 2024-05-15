<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_periodo extends Model
{
    use HasFactory;

    protected $table = 'tipos_periodos';
    /**
     * The attributes that are mass assignable.
     *
    // //  * @var array<int, string>
     */
    protected $fillable = [
        'periodo',

    ];
}
