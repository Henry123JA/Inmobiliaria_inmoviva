<?php

namespace App\Models;
use App\Models\Inventario;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPropiedad extends Model
{
    use HasFactory;
    protected $table = 'tipo_propiedads';

    protected $fillable = ['nombre', 'descripcion'];

    public function inventario()
    {
        return $this->hasMany(Inventario::class);
    }
}
