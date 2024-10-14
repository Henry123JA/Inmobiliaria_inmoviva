<?php

namespace App\Models;
use App\Models\Inventario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propiedad extends Model
{
    use HasFactory;
    protected $table = 'propiedades';
        protected $fillable = [
        'nombre','estado','descripcion','imagen'
    ];

    public function inventario()
    {
        return $this->hasMany(Inventario::class);
    }


  
}

