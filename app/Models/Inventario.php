<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Propiedad;
use App\Models\TipoPropiedad;
use App\Models\Agente;



class Inventario extends Model
{
    use HasFactory;
    protected $fillable = [
          'tipopropiedad_id','propiedad_id','agente_id',
        'fecha','direccion','precio','estado','superficie',
        'habitaciones','baños','descripcion','imagen'
      
    ];



    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class,'propiedad_id');
    }
    public function tipoPropiedad()
    {
        return $this->belongsTo(TipoPropiedad::class,'tipopropiedad_id');
    }

    // public function tipoPropiedad()
    // {
    //     return $this->belongsTo(TipoPropiedad::class, 'tipo_de_propiedad_id');
    // }

  
    public function agente()
    {
        return $this->belongsTo(Agente::class,'agente_id');
    }
}
