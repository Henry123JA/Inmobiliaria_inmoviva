<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    use HasFactory;

    // Especificar el nombre de la tabla en singular
    protected $table = 'formulario';

    // Definir los campos que pueden ser rellenados en la base de datos
    protected $fillable = [
        'nombre',
        'correo',
        'telefono',
        'mensaje',
    ];
}


