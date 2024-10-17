<?php

use App\Models\formulario;
use App\Http\Livewire\Articulos;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\AgenteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ClientesController;

use App\Http\Controllers\ReporteController;

use App\Http\Controllers\BitacoraController;

use App\Http\Controllers\ArticulosController;
use App\Http\Controllers\NotaVentaController;
use App\Http\Controllers\formularioController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\PropiedadController;
use App\Http\Controllers\TipoPropiedadController;

Route::get('/formularios', [formularioController::class, 'index'])->name('formulario.index');
Route::get('/formularios/crear', [formularioController::class, 'create'])->name('formulario.create');
Route::post('/formularios', [formularioController::class, 'store'])->name('formulario.store');
Route::get('/formularios/{id}', [formularioController::class, 'show'])->name('formulario.show');
Route::get('/formularios/{id}/editar', [formularioController::class, 'edit'])->name('formulario.edit');
Route::put('/formularios/{id}', [formularioController::class, 'update'])->name('formulario.update');
Route::delete('/formularios/{id}', [formularioController::class, 'destroy'])->name('formulario.destroy');


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Asegúrate de que todos estos métodos existan en los controladores correspondientes
    Route::get('/users/{user}/bitacora', [UsersController::class, 'showBitacora'])->name('users.bitacora');
    Route::get('/users/clientes', [UsersController::class, 'clientes'])->name('users.clientes');

    //agentes
    //Route::get('/users/agentes', [AgenteController::class, 'agentes'])->name('users.agentes');
    //Route::resource('agentes', AgenteController::class);
    Route::get('/users/propietarios', [UsersController::class, 'propietarios'])->name('users.propietarios');
    // Route::resource('/propiedades', PropiedadController::class);
    Route::get('/inventarios/pdf', [InventarioController::class, 'pdf'])->name('inventarios.pdf');

    
});

Route::resource('agentes', AgenteController::class);
Route::resource('tipo-propiedades', TipoPropiedadController::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('notaventa', VentaController::class);

Route::group(['middleware' => 'auth'], function () {
    Route::resource('users', UsersController::class);
    Route::resource('/marca', MarcaController::class);
    Route::get('/users/clientes', [UsersController::class, 'clientes'])->name('users.clientes');
    Route::get('/users/propietarios', [UsersController::class, 'propietarios'])->name('users.propietarios');
    Route::resource('/propiedades', PropiedadController::class);
    Route::resource('/inventarios', InventarioController::class);
 Route::get('/inventarios/pdf', [InventarioController::class, 'pdf'])->name('inventarios.pdf');
    //Route::get('/inventarios/pdf/', [InventarioController::class, 'pdf'])->where('id', '[0-9]+');
   // Route::get('/inventarios/{id}', [InventarioController::class, 'show'])->name('inventarios.show');
  //  Route::get('/inventarios/{id}', [InventarioController::class, 'show'])->where('id', '[0-9]+')->name('inventarios.show');


    Route::resource('clientes', ClientesController::class);

    // Para Livewire componentes normalmente no se definen de esta manera
    Route::resource('articulos', Articulos::class);
    Route::resource('inventario', ArticulosController::class);
    Route::get('/users/{user}/bitacora', [UsersController::class, 'showBitacora'])->name('users.bitacora');

    //pagos con stripe
    Route::get('/pagos/checkout', [StripeController::class, 'checkout'])->name('pagos.checkout');
    Route::get('/checkout', [StripeController::class, 'checkout'])->name('checkout');
    Route::post('/session', 'App\Http\Controllers\StripeController@session')->name('session');
    Route::get('/success', 'App\Http\Controllers\StripeController@success')->name('success');

    //Reportes
    Route::get('/reporte', [ReporteController::class, 'export'])->name('export');


    // Rutas para listar, crear, almacenar, mostrar, editar, actualizar y eliminar ventas
    Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
    Route::get('/ventas/create', [VentaController::class, 'create'])->name('ventas.create');
    Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');
    Route::get('/ventas/{venta}', [VentaController::class, 'show'])->name('ventas.show');
    Route::get('/ventas/{venta}/edit', [VentaController::class, 'edit'])->name('ventas.edit');
    Route::put('/ventas/{venta}', [VentaController::class, 'update'])->name('ventas.update');
    Route::delete('/ventas/{venta}', [VentaController::class, 'destroy'])->name('ventas.destroy');
    Route::get('/ventas/print/{periodo}/{fecha?}', [VentaController::class, 'print'])->name('ventas.print');

    //carrito de compras  
    Route::post('add-to-cart', [ArticulosController::class, 'addToCart'])->name('add_to_cart');
    Route::get('pagos/carrito-index', [ArticulosController::class, 'cart'])->name('pagos.carrito-index');
    Route::post('update-cart', [ArticulosController::class, 'updateCart'])->name('update_cart');
    Route::post('remove-from-cart', [ArticulosController::class, 'removeFromCart'])->name('remove_from_cart');
    Route::post('clear-cart', [ArticulosController::class, 'clearCart'])->name('clear_cart');

    //Route::get('pagos/checkout', [StripeController::class, 'checkout'])->name('checkout');


    //factura del carrito
    Route::get('/invoice', [InvoiceController::class, 'print'])->name('invoice.print');

    Route::resource('inventario', ArticulosController::class);

    //para bitacora
    Route::get('/users/{user}/bitacora', [UsersController::class, 'showBitacora'])->name('users.bitacora');
    Route::get('/bitacora/{userId}', [BitacoraController::class, 'showBitacora'])->name('show.bitacora');

    //pedidos

    Route::get('/pedidos/{id}/reporte-ganancia', [PedidoController::class, 'reporte_ganancia'])->name('pedidos.reporte_ganancia');
    Route::get('/pedidos/actualizar-stock-minimo', [PedidoController::class, 'actualizarStockMinimoForm'])->name('pedidos.actualizarStockMinimoForm');
    Route::post('/pedidos/actualizar-stock-minimo', [PedidoController::class, 'setStockMinimo'])->name('pedidos.setStockMinimo');
    Route::resource('pedidos', PedidoController::class);
});
