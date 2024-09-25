<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TipoPropiedad;

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
        'tipo_de_propiedad_id',
        'fecha_envio'
    ];

    // Relación con el modelo TipoDePropiedad
    public function tipoPropiedad()
    {
        return $this->belongsTo(TipoPropiedad::class, 'tipo_de_propiedad_id');
    }
}


