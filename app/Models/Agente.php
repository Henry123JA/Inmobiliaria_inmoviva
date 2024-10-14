<?php

namespace App\Models;
use App\Models\Inventario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agente extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'correo', 'telefono'];

    public function inventario()
    {
        return $this->hasMany(Inventario::class);
    }

}
