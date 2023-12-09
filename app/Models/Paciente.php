<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes';

    protected $fillable =[
        'user_id',
        'nombre',
        'apellidos',
        'correo_electronico',
        'num_celular',
        'ubicacion',
    ];
}
