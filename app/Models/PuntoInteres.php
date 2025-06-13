<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PuntoInteres extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'punto_interes';

    // Campos que se pueden asignar de forma masiva
    protected $fillable = [
        'nombre',
        'descripcion',
        'categoria',
        'imagen',
        'latitud',
        'longitud'
    ];
}

