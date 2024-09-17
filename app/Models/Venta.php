<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = [
        'user_id',
        'fecha',
        'total',
        'metodo_de_pago'
    ];

    public function articulos()
    {
        return $this->belongsToMany(Articulo::class)
            ->withPivot('cantidad', 'precio_unitario')
            ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
