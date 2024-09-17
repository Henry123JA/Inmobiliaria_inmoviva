<?php

namespace App\Models;

use App\Models\Modelo;
use App\Models\Categoria;
use App\Models\marca;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Events\ArticuloCreated;
use App\Events\ArticuloUpdated;

class Articulo extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre',
        'imagen',
        'precio_unitario',
        'precio_mayor',
        'precio_promedio',
        'stock',
        'descripcion',
        'marca_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($articulo) {
            if (!app()->runningInConsole()) {
                event(new ArticuloCreated($articulo));
            }
        });

        static::updated(function ($articulo) {
            if (!app()->runningInConsole()) {
                event(new ArticuloUpdated($articulo));
            }
        });
    }

    public function marca()
    {
        return $this->belongsTo(marca::class);
    }

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'pedido_articulo')
                    ->withPivot('cantidad', 'precio','importe')
                    ->withTimestamps();
    }

    public function ventas()
    {
        return $this->belongsToMany(Venta::class)
            ->withPivot('cantidad', 'precio_unitario')
            ->withTimestamps();
    }

    //implementación para facturas
    public function factura()
    {
        return $this->belongsToMany(Factura::class)
            ->withPivot('cantidad', 'precio_unitario')
            ->withTimestamps();
    }

    public function getContent()
    {
        return [
            'id' => $this->id,
            'name' => $this->nombre,
            'price' => $this->precio_unitario,
            // Otros atributos del artículo que desees incluir en el contenido del carrito
        ];
    }
}
