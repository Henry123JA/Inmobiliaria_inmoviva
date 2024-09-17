<?php

namespace App\Http\Controllers;

use App\Models\marca;
use Livewire\Component;
use App\Models\Articulo;
use App\Events\ArticuloViewed;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Bitacora;

class ArticulosController extends Controller
{
    use WithFileUploads;

    // Reglas de validación para los campos del formulario
    protected $rules = [
        'codigo' => 'required|string',
        'nombre' => 'required|string',
        'imagen',
        'precio_unitario' => 'required|numeric|min:0',
        'precio_mayor' => 'required|numeric|min:0',
        'precio_promedio' => 'nullable|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'descripcion' => 'nullable|string',

        'marca_id' => 'required|exists:marcas,id'
    ];

    // Muestra una lista de artículos del inventario
    public function index()
    {
        $articulos = Articulo::all();
        return view('inventario.index', compact('articulos'));
    }

    // Muestra el formulario para crear un nuevo artículo del inventario
    public function create()
    {
        //$categorias = Categoria::all();
        $marcas = marca::all();
        //$modelos = Modelo::all();

        return view('inventario.create', compact('marcas'));
    }

    // Almacena un nuevo artículo del inventario en la base de datos
    public function store(Request $request)
    {
        $request->validate($this->rules);
        $input = $request->all();
        if ($file = $request->file('imagen')) {
            $nombreImagen = time() . '_' . $file->getClientOriginalName();
            $ruta = $file->storeAs('public/imagenes/articulos', $nombreImagen);
            $input['imagen'] = Storage::url($ruta);
        }
        Articulo::create($input);

        return redirect()->route('inventario.index')->with('success', 'Artículo creado exitosamente.');
    }

    public function edit($id)
    {
        $articulo = Articulo::findOrFail($id);
        //$categorias = Categoria::all();
        $marcas = marca::all();
        //$modelos = Modelo::all();

        return view('inventario.edit', compact('articulo', 'marcas'));
    }


    public function update(Request $request, $id)
    {
        $request->validate($this->rules);
        $articulo = Articulo::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('imagen')) {
            $nombreImagen = time() . '_' . $file->getClientOriginalName();
            $ruta = $file->storeAs('public/imagenes/articulos', $nombreImagen);
            $input['imagen'] = Storage::url($ruta);
        } else {
            unset($input['imagen']);
        }
        $articulo->update($input);
        return redirect()->route('inventario.index')->with('success', 'Artículo actualizado exitosamente.');
    }

    public function show($id)
    {
        $articulo = Articulo::with([ 'marca'])->findOrFail($id);
        event(new ArticuloViewed($articulo));
        return view('inventario.show', compact('articulo'));
    }


    public function destroy($id)
    {
        $articulo = Articulo::find($id);
        if (!$articulo) {
            return redirect()->route('inventario.index')->with('error', 'El artículo no existe');
        }
        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Eliminacion de articulo',
                'details' => 'El articulo ' . $articulo->nombre . ' ha sido eliminado',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        $articulo->delete();
        return redirect()->route('inventario.index')->with('success', 'Artículo eliminado correctamente');
    }



    public function home()
    {
        $articulos = Articulo::all();
        return view('pagos.checkout', compact('articulos'));
    }

    //añadir articulo al carrito
    public function addToCart(Request $request)
    {
        // Buscar el artículo por su ID
        $articulo = Articulo::find($request->id);

        // Añadir el artículo al carrito en la sesión
        $cart = session()->get('cart', []);

        // Verificar si el artículo existe
        if (!$articulo) {
            return back()->with('error', 'El artículo no existe.');
        }

        // Verificar si el artículo ya está en el carrito y actualizar la cantidad
        if (isset($cart[$articulo->id])) {
            $newQuantity = $cart[$articulo->id]['quantity'] + $request->quantity;

            // Verificar si hay suficiente stock
            if ($articulo->stock < $newQuantity) {
                return back()->with('error', 'No hay suficiente stock para el artículo: ' . $articulo->nombre);
            }

            $cart[$articulo->id]['quantity'] = $newQuantity;
        } else {
            // Verificar si hay suficiente stock
            if ($articulo->stock < $request->quantity) {
                return back()->with('error', 'No hay suficiente stock para el artículo: ' . $articulo->nombre);
            }

            // Obtener datos del formulario
            $cart[$articulo->id] = [
                'id' => $articulo->id,
                'name' => $articulo->nombre,
                'price' => $articulo->precio_unitario,
                'quantity' => $request->quantity,
                'image' => $articulo->imagen, // Asegúrate de que $articulo->imagen sea la ruta o nombre correcto de la imagen
                'available_stock' => $articulo->stock // Agregar el stock disponible
            ];
        }

        // Guardar el carrito actualizado en la sesión
        session()->put('cart', $cart);

        // Redireccionar de vuelta a la página de checkout (o donde sea necesario)
        return redirect()->back()->with('success', '¡Artículo agregado al carrito!');
    }




    public function cart()
    {
        $cartItems = session()->get('cart', []);
        return view('pagos.carrito-index', compact('cartItems'));
    }

    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->route('pagos.carrito-index')->with('success', '¡Carrito actualizado!');
        }

        return redirect()->route('pagos.carrito-index')->with('error', '¡Artículo no encontrado en el carrito!');
    }

    // CartController.php
    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
            return redirect()->route('pagos.carrito-index')->with('success', '¡Artículo eliminado del carrito!');
        }

        return redirect()->route('pagos.carrito-index')->with('error', '¡Artículo no encontrado en el carrito!');
    }

    //vacia el carrito despues de pagar
    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->route('articulos.index')->with('success', '¡Carrito vaciado!');
    }
}
