<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


//manda los datos a la factura a imprimir
class InvoiceController extends Controller
{
    public function print(Request $request)
    {
        // Obtener los artículos del carrito desde la sesión
        $cartItems = session()->get('cart', []);

        // Calcular el total de la factura
        $total = array_reduce($cartItems, function($carry, $item) {
            return $carry + $item['price'] * $item['quantity'];
        }, 0);

        // Obtener el cliente actualmente autenticado
        $cliente = Auth::user();

        // Mostrar la vista de la factura con los datos necesarios
        return view('pagos.invoice', compact('cartItems', 'total', 'cliente'));
    }
}
