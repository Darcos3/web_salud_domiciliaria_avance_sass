<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historia extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_profesional',
        'id_paciente',
        'inf_relevante',
        'consecutivo',
        'estado',
        'inf_antecedentes',
        'evolucion_final',
        'concepto_profesional',
        'recomendaciones',
        'fecha',
        'hora',
        'imagen',
        'firma'
    ];

    public function getUrlPathAtribute(){
        return Storage::url($this->imagen);
    }
}
