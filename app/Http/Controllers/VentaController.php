<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Articulo;
use App\Models\User;
use App\Models\Bitacora;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with(['articulos', 'user'])->get();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $users = User::all();
        $articulos = Articulo::all();
        return view('ventas.create', compact('users', 'articulos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'articulos_seleccionados' => 'required|array',
            'articulos_seleccionados.*' => 'exists:articulos,id',
            'metodo_de_pago' => 'required|in:efectivo,tarjeta,qr,otro',
        ]);

        $articulosSeleccionados = Articulo::whereIn('id', $request->articulos_seleccionados)->get();

        foreach ($articulosSeleccionados as $articulo) {
            $cantidadSeleccionada = $request->input('articulos.' . $articulo->id . '.cantidad', 0);
            if ($cantidadSeleccionada > $articulo->stock) {
                return redirect()->back()->withInput()->withErrors(['stock_insuficiente' => 'No hay suficiente stock para el artículo: ' . $articulo->nombre]);
            }
        }

        $venta = Venta::create([
            'user_id' => $request->user_id,
            'fecha' => now(),
            'total' => 0, 
            'metodo_de_pago' => $request->metodo_de_pago,
        ]);

        $totalVenta = 0; 

        foreach ($articulosSeleccionados as $articulo) {
            $cantidad = $request->input('articulos.' . $articulo->id . '.cantidad', 0);
            $precioUnitario = $request->input('articulos.' . $articulo->id . '.precio_unitario', $articulo->precio_promedio);
            $importe = $cantidad * $precioUnitario;

            $venta->articulos()->attach($articulo->id, [
                'cantidad' => $cantidad,
                'precio_unitario' => $precioUnitario,
                'importe' => $importe,
            ]);

            $articulo->decrement('stock', $cantidad);

            $totalVenta += $importe;
        }

        $venta->update(['total' => $totalVenta]);

        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Creación de nota de venta',
                'details' => 'La nota de venta de ' . $venta->user->name . ' ha sido creada',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }

        return redirect()->route('ventas.index')->with('success', 'Venta creada correctamente');
    }
    
    

    public function show($id)
    {
        $venta = Venta::with(['articulos', 'user'])->findOrFail($id);

        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Visualización de la nota de venta',
                'details' => 'El detalle de la nota de venta de ' . $venta->user->name . ' ha sido visto',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }

        return view('ventas.show', compact('venta'));
    }

    public function edit($id)
    {
        $venta = Venta::findOrFail($id);
        $users = User::all();
        $articulos = Articulo::all();
        return view('ventas.edit', compact('venta', 'users', 'articulos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'articulos_seleccionados' => 'required|array',
            'articulos_seleccionados.*' => 'exists:articulos,id',
            'metodo_de_pago' => 'required|in:efectivo,tarjeta,qr,otro',
        ]);

        $venta = Venta::findOrFail($id);

        $articulosSeleccionados = Articulo::whereIn('id', $request->articulos_seleccionados)->get();

        foreach ($articulosSeleccionados as $articulo) {
            $cantidadActual = $venta->articulos->firstWhere('id', $articulo->id)->pivot->cantidad ?? 0;
            $cantidadNueva = $request->input('articulos.' . $articulo->id . '.cantidad', 0);
            $diferenciaCantidad = $cantidadNueva - $cantidadActual;

            if ($diferenciaCantidad > 0) {
                if ($diferenciaCantidad <= $articulo->stock) {
                    $articulo->increment('stock', $diferenciaCantidad);
                } else {
                    return redirect()->back()->withInput()->withErrors(['stock_insuficiente' => 'No hay suficiente stock para aumentar la cantidad del artículo: ' . $articulo->nombre]);
                }
            } elseif ($diferenciaCantidad < 0) {
                if ($cantidadNueva <= $articulo->stock) {
                    $articulo->decrement('stock', abs($diferenciaCantidad));
                } else {
                    return redirect()->back()->withInput()->withErrors(['stock_insuficiente' => 'No hay suficiente stock para la cantidad solicitada del artículo: ' . $articulo->nombre]);
                }
            }
        }

        $venta->update([
            'user_id' => $request->user_id,
            'metodo_de_pago' => $request->metodo_de_pago,
        ]);

        foreach ($articulosSeleccionados as $articulo) {
            $cantidad = $request->input('articulos.' . $articulo->id . '.cantidad', 0);
            $precioUnitario = $request->input('articulos.' . $articulo->id . '.precio_unitario', $articulo->precio_promedio);
            $importe = $cantidad * $precioUnitario;

            $venta->articulos()->syncWithoutDetaching([$articulo->id => [
                'cantidad' => $cantidad,
                'precio_unitario' => $precioUnitario,
                'importe' => $importe,
            ]]);
        }

        $totalVenta = $venta->articulos->sum(function ($articulo) {
            return $articulo->pivot->importe;
        });
        $venta->update(['total' => $totalVenta]);

        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Edición de nota de venta',
                'details' => 'La nota de venta de ' . $venta->user->name . ' ha sido editada',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }

        return redirect()->route('ventas.index')->with('success', 'Venta editada correctamente');
    }

    public function print(Request $request, $periodo, $fecha = null)
    {
        $ventas = $this->obtenerVentasSegunPeriodo($periodo, $fecha);

        return view('ventas.print', compact('ventas', 'periodo', 'fecha'));
    }

    protected function obtenerVentasSegunPeriodo($periodo, $fecha = null)
    {
        $query = Venta::query();

        switch ($periodo) {
            case 'dia':
                $query->whereDate('fecha', now()->format('Y-m-d'));
                break;
            case 'mes':
                $query->whereYear('fecha', now()->year)
                    ->whereMonth('fecha', now()->month);
                break;
            case 'anio':
                $query->whereYear('fecha', now()->year);
                break;
            default:
                throw new \InvalidArgumentException('Período no válido');
        }

        return $query->get();
    }

    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);

        foreach ($venta->articulos as $articulo) {
            $articulo->increment('stock', $articulo->pivot->cantidad);
        }

        $venta->delete();

        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Eliminación de nota de venta',
                'details' => 'La nota de venta de ' . $venta->user->name . ' ha sido eliminada',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente');
    }
    
}
