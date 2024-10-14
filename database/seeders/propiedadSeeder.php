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
            'descripcion' => 'Propiedad independiente de una planta con 3 habitaciones en el centro de la ciudad.',
            'imagen' => 'public/imagenes/propiedades'
         ],
     
         [
            'id'  => 2,
            'nombre' => 'Apartamento con vista al mar',
            'estado' => 'Renovada',
            'descripcion' => 'Apartamento en edificio con varias unidades habitacionales, en la playa con vista al mar.',
            'imagen' => 'public/imagenes/propiedades'
         ],
     
         [
            'id'  => 3,
            'nombre' => 'Oficina en Edificio A',
            'estado' => 'Renovada',
            'descripcion' => 'Espacio destinado a actividades laborales, oficina en el centro empresarial.',
            'imagen' => 'public/imagenes/propiedades'
         ],
     
         [
            'id'  => 4,
            'nombre' => 'Casa de Campo en zona rural',
            'estado' => 'En construcción',
            'descripcion' => 'Propiedad independiente en zona rural, perfecta para descanso.',
            'imagen' => 'public/imagenes/propiedades'
         ],
     
         [
            'id'  => 5,
            'nombre' => 'Local Comercial en el centro',
            'estado' => 'Renovada',
            'descripcion' => 'Propiedad destinada a fines comerciales, local con buena ubicación.',
            'imagen' => 'public/imagenes/propiedades'
         ],
     
         [
            'id'  => 6,
            'nombre' => 'Apartamento moderno en la ciudad',
            'estado' => 'Nueva',
            'descripcion' => 'Apartamento en edificio moderno en la ciudad.',
            'imagen' => 'public/imagenes/propiedades'
         ],
     
         [
            'id'  => 7,
            'nombre' => 'Terreno en zona urbanizable',
            'estado' => 'Usada',
            'descripcion' => 'Espacio de tierra destinado para construcción, terreno de 500 m² en zona urbanizable.',
            'imagen' => 'public/imagenes/propiedades'
         ],
     
         [
            'id'  => 8,
            'nombre' => 'Chalet en la Montaña con vistas',
            'estado' => 'Nueva',
            'descripcion' => 'Propiedad con vistas impresionantes en zona montañosa.',
            'imagen' => 'public/imagenes/propiedades'
         ]
     ];
     
         Propiedad::insert($propiedades);
    }
}
