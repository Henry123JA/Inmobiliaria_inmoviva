<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'proveedor_id', 'fecha', 'estado', 'total','sw'];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
 
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }    
    public function articulos()
    {
        return $this->belongsToMany(Articulo::class, 'pedido_articulo')
                    ->withPivot('cantidad', 'precio','importe')
                    ->withTimestamps();
    }
}
