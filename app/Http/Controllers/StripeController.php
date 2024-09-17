<?php

namespace App\Http\Controllers;

use DB;
use Stripe\Stripe;
use App\Models\Venta;
use App\Models\Factura;
use App\Models\Articulo;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    public function checkout()
    {
        $articulos = Articulo::all();
        return view('pagos.checkout', compact('articulos'));
    }

    public function session(Request $request)
    {
        $ids_articulos = $request->input('articulo_id');
        $articulos_quantities = $request->input('articulo_quantity');

        if (!$ids_articulos) {
            return redirect()->back()->with('error', 'No se han seleccionado artículos para comprar.');
        }

        Stripe::setApiKey(config('stripe.sk'));

        $articulos = Articulo::whereIn('id', $ids_articulos)->get();

        $lineItems = [];
        $cartItems = [];
        foreach ($articulos as $item) {
            $cantidad = $articulos_quantities[$item->id];
            $precio_unitario = $item->precio_unitario;
            $subtotal = $precio_unitario * $cantidad;

            $cartItems[] = [
                'id' => $item->id,
                'name' => $item->nombre,
                'quantity' => $cantidad,
                'price' => $precio_unitario,
                'subtotal' => $subtotal,
            ];

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item->nombre,
                    ],
                    'unit_amount' => $precio_unitario * 100,
                ],
                'quantity' => $cantidad,
            ];
        }

        session()->put('cartItems', $cartItems);
        session()->put('total', array_sum(array_column($cartItems, 'subtotal')));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('checkout'),
        ]);

        return redirect()->away($session->url);
    }

    public function success()
    {
        // Obtener los datos del carrito de la sesión
        $cartItems = session()->get('cart', []);
        $total = session()->get('total', 0);

        // Verificar si el carrito está vacío
        if (empty($cartItems)) {
            return redirect()->route('pagos.checkout')->with('error', 'El carrito está vacío.');
        }

        try {
            // Iniciar una transacción para asegurar la consistencia de los datos
            \DB::transaction(function () use ($cartItems, $total) {
                // Primero, verificar si hay suficiente stock para todos los artículos
                foreach ($cartItems as $item) {
                    // Buscar el artículo
                    $articulo = Articulo::find($item['id']);
                    if (!$articulo) {
                        throw new \Exception('El artículo no existe: ' . $item['name']);
                    }
                    // Verificar si hay suficiente stock
                    if ($articulo->stock < $item['quantity']) {
                        throw new \Exception('No hay suficiente stock para el artículo: ' . $articulo->nombre);
                    }
                }

                // Crear la venta en la base de datos
                $venta = Venta::create([
                    'user_id' => auth()->id(), // Obtener el ID del usuario autenticado
                    'fecha' => now(), // Guardar la fecha actual
                    'total' => $total, // Guardar el total de la venta
                ]);

                // Guardar los detalles de cada artículo en la venta y descontar del stock
                foreach ($cartItems as $item) {
                    // Buscar el artículo
                    $articulo = Articulo::find($item['id']);

                    // Descontar del stock
                    $articulo->stock -= $item['quantity'];
                    $articulo->save();

                    // Guardar el detalle de la venta
                    $venta->articulos()->attach($item['id'], [
                        'cantidad' => $item['quantity'],
                        'precio_unitario' => $item['price'],
                        'importe' => $item['price'] * $item['quantity'],
                    ]);
                }

                // Crear la factura en la base de datos
                $factura = Factura::create([
                    'user_id' => auth()->id(),
                    'nombre' => 'Factura ' . now()->format('d-m-Y H:i:s'),
                    'subtotal' => $total,
                    'total' => $total,
                ]);

                // Guardar los detalles de cada artículo en la factura
                foreach ($cartItems as $item) {
                    $factura->articulos()->attach($item['id'], [
                        'cantidad' => $item['quantity'],
                        'precio_unitario' => $item['price'],
                    ]);
                }

                // Limpiar el carrito de la sesión
                session()->forget('cart');
                session()->forget('total');
            });

            // Verificar si los valores han sido eliminados correctamente
            $cartItems = session()->get('cart', []);
            $total = session()->get('total', 0);

            if (empty($cartItems) && $total == 0) {
                // Redirigir a la vista de checkout con un mensaje de éxito
                return redirect()->route('pagos.checkout')->with('success', 'Pago completado con éxito');
            } else {
                return redirect()->route('pagos.checkout')->with('error', 'Error al vaciar el carrito.');
            }
        } catch (\Exception $e) {
            // Manejar la excepción y redirigir con un mensaje de error
            return redirect()->route('pagos.checkout')->with('error', $e->getMessage());
        }
    }
}
