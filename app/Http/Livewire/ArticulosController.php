<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Articulos as Articulo;
use App\Models\Bitacora;
class Articulos extends Component
{
    // Propiedades públicas para almacenar los datos del formulario y el estado del artículo
    public $codigo, $nombre, $tipo, $precio_unitario, $precio_mayor, $precio_promedio, $stock, $descripcion;
    public $updateArticle = false; // Estado para indicar si se está editando un artículo
    public $article_id; // ID del artículo en edición
    public $articles; // Lista de artículos

    // Reglas de validación para los campos del formulario
    protected $rules = [
        'codigo' => 'required|unique:articulos,codigo',
        'nombre' => 'required',
        'tipo' => 'required',
        'precio_unitario' => 'required|numeric',
        'precio_mayor' => 'required|numeric',
        'precio_promedio' => 'required|numeric',
        'stock' => 'required|numeric',
        'descripcion' => 'required',
    ];

    // Renderiza la vista y carga los artículos
    public function render()
    {
        $this->articles = Articulo::all();
        return view('livewire.articulos');
    }

    // Restablece los campos del formulario
    public function resetFields()
    {
        $this->codigo = '';
        $this->nombre = '';
        $this->tipo = '';
        $this->precio_unitario = '';
        $this->precio_mayor = '';
        $this->precio_promedio = '';
        $this->stock = '';
        $this->descripcion = '';
    }

    // Guarda un nuevo artículo en la base de datos
    public function store()
    {
        $this->validate(); // Validar los campos del formulario

        Articulo::create([
            'codigo' => $this->codigo,
            'nombre' => $this->nombre,
            'tipo' => $this->tipo,
            'precio_unitario' => $this->precio_unitario,
            'precio_mayor' => $this->precio_mayor,
            'precio_promedio' => $this->precio_promedio,
            'stock' => $this->stock,
            'descripcion' => $this->descripcion,
        ]);

        session()->flash('success', 'Artículo creado exitosamente!');
        $this->resetFields(); // Restablecer los campos del formulario después de guardar
    }

    // Cargar los datos de un artículo en el formulario para editar
    public function edit($id)
    {
        $article = Articulo::findOrFail($id);
        $this->codigo = $article->codigo;
        $this->nombre = $article->nombre;
        $this->tipo = $article->tipo;
        $this->precio_unitario = $article->precio_unitario;
        $this->precio_mayor = $article->precio_mayor;
        $this->precio_promedio = $article->precio_promedio;
        $this->stock = $article->stock;
        $this->descripcion = $article->descripcion;
        $this->article_id = $id;
        $this->updateArticle = true;
    }

    // Actualizar los datos de un artículo en la base de datos
    public function update()
    {
        $this->validate(); // Validar los campos del formulario

        Articulo::find($this->article_id)->update([
            'codigo' => $this->codigo,
            'nombre' => $this->nombre,
            'tipo' => $this->tipo,
            'precio_unitario' => $this->precio_unitario,
            'precio_mayor' => $this->precio_mayor,
            'precio_promedio' => $this->precio_promedio,
            'stock' => $this->stock,
            'descripcion' => $this->descripcion,
        ]);

        session()->flash('success', 'Artículo actualizado exitosamente!');
        $this->resetFields(); // Restablecer los campos del formulario después de actualizar
        $this->updateArticle = false; // Desactivar el modo de actualización
    }

    // Eliminar un artículo de la base de datos
    public function destroy($id)
    {
        $articulo = Articulo::find($id);
        
       
        $articulo->delete();

        session()->flash('success', 'Artículo eliminado exitosamente!');
    }
}
