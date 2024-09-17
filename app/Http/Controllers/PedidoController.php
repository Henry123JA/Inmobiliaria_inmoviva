<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use App\Models\Articulo;
use App\Models\User;
use App\Models\Bitacora;
use App\Models\Setting;
class PedidoController extends Controller
{
    
    
    public function index()
    {
        // Cargar los pedidos con las relaciones user y proveedor
        $pedidos = Pedido::with(['user', 'proveedor'])->get();
        return view('pedidos.index', compact('pedidos'));
    }
    
    public function create()
    {
        $proveedores = Proveedor::all();
        $articulosConStockBajo = Articulo::where('stock', '<=', Setting::getValue('stock_minimo', 10))->get();
        return view('pedidos.create', compact('proveedores', 'articulosConStockBajo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'proveedor_id' => 'required|exists:proveedors,id',
            'estado' => 'required|string',
            'articulos' => 'required|array',
            'articulos.*.seleccionado' => 'nullable|boolean',
            'articulos.*.id' => 'required_if:articulos.*.seleccionado,true|exists:articulos,id',
            'articulos.*.cantidad' => 'nullable|integer|min:0',
            'articulos.*.precio_unitario' => 'nullable|numeric|min:0',
        ]);

        // Verificar si al menos un artículo está seleccionado
        $articulosSeleccionados = collect($request->articulos)->filter(function ($articulo) {
            return isset($articulo['seleccionado']) && $articulo['seleccionado'];
        });

        if ($articulosSeleccionados->isEmpty()) {
            return redirect()->back()->with('error', 'Debe seleccionar al menos un artículo para crear el pedido.');
        }

        $user = auth()->user();

        $pedido = Pedido::create([
            'user_id' => $user->id,
            'fecha' => now(),
            'estado' => $request->estado,
            'total' => 0,
        ]);
        
        // Registro en la bitácora
        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Creación de pedido',
                'details' => 'El pedido de ' . $pedido->user->name . ' ha sido creado',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }

        foreach ($request->articulos as $articulo) {
            if (isset($articulo['seleccionado']) && $articulo['seleccionado']) {
                $cantidad = $articulo['cantidad'] ?? 0;  // Si no se proporciona cantidad, se establece como 0
                $precioUnitario = $articulo['precio_unitario'] ?? 0;  // Si no se proporciona precio_unitario, se establece como 0
                $importe = $cantidad * $precioUnitario;

                $pedido->articulos()->attach($articulo['id'], [
                    'cantidad' => $cantidad,
                    'precio' => $precioUnitario,
                    'importe' => $importe,
                ]);

                $pedido->total += $importe;
            }
        }

        $pedido->save();

        return redirect()->route('pedidos.index')->with('success', 'Pedido creado correctamente');
    }

    public function actualizarStockMinimoForm()
    {
        $stockActual = Setting::getValue('stock_minimo', 10); // Valor por defecto de 10
        return view('pedidos.actualizar_stock_minimo', compact('stockActual'));
    }

    public function setStockMinimo(Request $request)
    {
        $request->validate([
            'nuevo_stock_minimo' => 'required|integer|min:0',
        ]);

        $nuevoStockMinimo = $request->input('nuevo_stock_minimo');

        Setting::setValue('stock_minimo', $nuevoStockMinimo);

        return redirect()->route('pedidos.index')->with('success', 'Stock Mínimo actualizado correctamente.');
    }
    public function show($id)
    {
        $pedido = Pedido::with(['articulos', 'user', 'proveedor'])->findOrFail($id);

        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Visualización de pedido',
                'details' => 'El detalle del pedido de ' . $pedido->user->name . ' ha sido visto',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }

        return view('pedidos.show', compact('pedido'));
    }
    public function reporte_ganancia($id)
    {
        // Obtener el pedido específico
        $pedido = Pedido::with('articulos')->findOrFail($id);

        // Calcular la ganancia por artículo
        $articulosConGanancia = $pedido->articulos->map(function ($articulo) {
            $articulo->ganancia = $articulo->precio_unitario - $articulo->pivot->precio;
            return $articulo;
        });

        return view('pedidos.reporte_ganancia', compact('articulosConGanancia', 'pedido'));
    }

    

    public function edit($id)
    {
        $pedido = Pedido::findOrFail($id);
        
        if ($pedido->sw) {
            return redirect()->route('pedidos.index')->with('success', 'El pedido ya ha sido recibido por eso ya no se puede modificar');
        }
        
        $articulos = $pedido->articulos()->get();
        $user = $pedido->user;
        $proveedores = Proveedor::all();
        
        return view('pedidos.edit', compact('pedido', 'user', 'proveedores', 'articulos'));
    }

    public function update(Request $request, Pedido $pedido)
    {
        $request->validate([
            'estado' => 'required|string|in:pendiente,cancelado,recibido',
            'articulos' => 'required|array',
            'articulos.*.id' => 'required|exists:articulos,id',
            'articulos.*.cantidad' => 'required|integer|min:0',
            'articulos.*.precio_unitario' => 'required|numeric|min:0',
        ]);

        // Actualizar el estado y el proveedor del pedido
        $pedido->estado = $request->estado;
        $pedido->proveedor_id = $request->proveedor_id;

        // Calcular el nuevo total
        $total = 0;

        foreach ($request->articulos as $articulo) {
            $cantidad = $articulo['cantidad'];
            $precioUnitario = $articulo['precio_unitario'];
            $importe = $cantidad * $precioUnitario;

            // Actualizar el artículo del pedido
            $pedido->articulos()->updateExistingPivot($articulo['id'], [
                'cantidad' => $cantidad,
                'precio' => $precioUnitario,
                'importe' => $importe,
            ]);

            // Sumar al total del pedido
            $total += $importe;
        }

        // Actualizar el total del pedido
        $pedido->total = $total;

        // Si el estado es 'recibido', actualizar el stock de los artículos
        if ($pedido->estado === 'recibido') {
            foreach ($request->articulos as $articulo) {
                $articuloModel = Articulo::find($articulo['id']);
                $articuloModel->stock += $articulo['cantidad'];
                $articuloModel->save();
            }

            // Cambiar el valor de sw a true
            $pedido->sw = true;
        }

        $pedido->save();

        // Registro en la bitácora
        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Actualización de pedido',
                'details' => 'El pedido de ' . $pedido->user->name . ' ha sido actualizado',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }

        return redirect()->route('pedidos.index')->with('success', 'Pedido actualizado correctamente');
    }

    
    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);

        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Eliminacion del pedido',
                'details' => 'El pedido de ' . $pedido->user->name . ' ha sido eliminado',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }

        $pedido->articulos()->detach();
        $pedido->proveedor()->dissociate(); 
        $pedido->delete();
        return redirect()->route('pedidos.index')->with('success', 'Pedido eliminado correctamente');
    }
}
