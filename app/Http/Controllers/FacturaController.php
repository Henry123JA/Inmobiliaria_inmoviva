<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Factura;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    /**
     * Almacena una nueva factura basada en una venta existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación básica, ajusta según tus necesidades
        $request->validate([
            'venta_id' => 'required|exists:ventas,id',
        ]);

        // Obtener la venta asociada
        $venta = Venta::findOrFail($request->venta_id);

        // Calcular subtotal y total
        $subtotal = 0;
        foreach ($venta->articulos as $articulo) {
            $subtotal += $articulo->pivot->cantidad * $articulo->pivot->precio_unitario;
        }

        // Crear la factura
        $factura = Factura::create([
            'user_id' => $venta->user_id,
            'nombre' => $venta->articulos->implode('nombre', ', '), // Concatenar nombres de artículos
            'precio_unitario' => null, // No se almacena el precio unitario directamente en la factura
            'subtotal' => $subtotal,
            'total' => $subtotal, // En este caso, total igual a subtotal
        ]);

        // Asociar los artículos a la factura
        $factura->articulos()->attach($venta->articulos->pluck('id'), function ($pivotData) use ($venta) {
            $articulo = $venta->articulos->firstWhere('id', $pivotData['articulo_id']);
            return [
                'cantidad' => $articulo->pivot->cantidad,
                'precio_unitario' => $articulo->pivot->precio_unitario,
            ];
        });

        // Redirigir o retornar la vista que desees
        return redirect()->route('pagos.checkout')->with('success', 'Factura creada exitosamente.');
    }
}
