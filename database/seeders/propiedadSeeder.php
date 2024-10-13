<?php

namespace Database\Seeders;
use App\Models\Propiedad;

use Illuminate\Database\Seeder;

class propiedadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $propiedades = [
            [
               'id'  => 1,
               'nombre' => 'Casa en el Centro',
               'estado' => 'Nueva',
               'descripcion'=>'Amplia casa con 3 habitaciones',
               'imagen'=>'public/imagenes/propiedades'

            ],
   
            [
               'id'  => 2,
               'nombre' => 'Apartamento en la Playa',
               'estado' => 'Renovada',
               'descripcion'=>'Apartamento con vista al mar.',
               'imagen'=>'public/imagenes/propiedades'

            ],
   
            [
               'id'  => 3,
               'nombre' => 'Oficina en el Edificio A',
               'estado' => 'Renovada',
                'descripcion'=>'Oficina en el centro empresarial.',
               'imagen'=>'public/imagenes/propiedades'

            ],
   
            [
               'id'  => 4,
               'nombre' => 'Casa de Campo',
               'estado' => 'En construcción',
                 'descripcion'=>'Casa en zona rural, perfecta para descanso.',
                 'imagen'=>'public/imagenes/propiedades'

            ],
   
            [
               'id'  => 5,
               'nombre' =>'Local Comercial',
               'estado' => 'Renovada',
                 'descripcion'=>'Local comercial con buena ubicación.',
                 'imagen'=>'public/imagenes/propiedades'

            ],
   
            [
               'id'  => 6,
               'nombre' => 'Apartamento Moderno',
               'estado' => 'Nueva',
                'descripcion'=>'Apartamento en edificio moderno.',
                'imagen'=>'public/imagenes/propiedades'

            ],
   
            [
               'id'  => 7,
               'nombre' => 'Terreno',
               'estado' => 'Usada',
             'descripcion'=>'Terreno de 500 m² en zona urbanizable.',
             'imagen'=>'public/imagenes/propiedades'

            ],
   
            [
               'id'  => 8,
               'nombre' => 'Chalet en la Montaña',
               'estado' => 'Nueva',
               'descripcion'=>'Chalet con vistas impresionantes.',
               'imagen'=>'public/imagenes/propiedades'
            ],
   
         ];
         Propiedad::insert($propiedades);
    }
}
