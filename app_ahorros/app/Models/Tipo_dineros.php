<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_dineros extends Model
{
    use HasFactory;

    protected $table = 'tipos_dineros';
    /**
     * The attributes that are mass assignable.
     *
    // //  * @var array<int, string>
     */
    protected $fillable = [
        'tipo',
    ];
}
