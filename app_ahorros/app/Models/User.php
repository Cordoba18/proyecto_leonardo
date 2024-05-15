<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
    // //  * @var array<int, string>
     */
    protected $fillable = [
        'nombres',
        'apellidos',
        'numero_de_identificacion',
        'email',
        'password',

    ];

}
