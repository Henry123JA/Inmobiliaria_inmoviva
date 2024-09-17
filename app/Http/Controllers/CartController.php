<?php

namespace App\Http\Controllers;

use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\Articulo;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function add(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'id' => 'required|exists:products,id',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1'
        ]);

        // Agregar el producto al carrito
        Articulo::add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array()
        ));

        return redirect()->back()->with('success', 'Articulo añadido al carrito!');
    }

    public function remove(Request $request)
    {
        Articulo::remove($request->id);
        return redirect()->back()->with('success', 'Articulo eliminado del carrito!');
    }

    public function clear()
    {
        Articulo::clear();
        return redirect()->back()->with('success', 'Carrito vaciado!');
    }

    public function cart()
    {
        $cartItems = Articulo::getContent();
        return view('pagos.carrito-index', compact('cartItems'));
    }
    
}
