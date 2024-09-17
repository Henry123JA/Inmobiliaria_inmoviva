<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Articulo;

class ArticuloIndex extends Component
{
    public $buscar = '';

    public function render()
    {
        $articulos = Articulo::where('nombre', 'like', '%' . $this->buscar . '%')->get();
        return view('livewire.articulo-index', ['articulos' => $articulos]);
    }

    // Método para emitir el evento 'updated' cuando cambia el valor de $buscar
    public function updatedBuscar($value)
    {
        $this->buscar = $value;
    }
}
