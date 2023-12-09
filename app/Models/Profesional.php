<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesional extends Model
{
    use HasFactory;

    protected $table = 'profesionales';

    protected $fillable =[
        'user_id',
        'nombre',
        'apellidos',
        'correo_electronico',
        'num_celular',
        'ubicacion',
    ];
}
