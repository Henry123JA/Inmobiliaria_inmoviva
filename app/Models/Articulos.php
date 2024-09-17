<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulos extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo',
        'nombre',
        'tipo',
        'precio_unitario',
        'precio_mayor',
        'precio_promedio',
        'stock',
        'descripcion'
    ];

    public $timestamps = true;

    
    public function venta()
    {
        return $this->hasMany(Venta::class);
    }
    
}
