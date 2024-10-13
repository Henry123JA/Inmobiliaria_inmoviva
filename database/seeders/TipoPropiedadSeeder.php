<?php

namespace Database\Seeders;

use App\Models\TipoPropiedad;
use Illuminate\Database\Seeder;

class TipoPropiedadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = [
            [
                'id' => 1,
                'nombre' => 'Casa',
                'descripcion' => 'Propiedad independiente de una o varias plantas destinada a vivienda.'
            ],
            [
                'id' => 2,
                'nombre' => 'Apartamento',
                'descripcion' => 'Vivienda en un edificio con varias unidades habitacionales.'
            ],
            [
                'id' => 3,
                'nombre' => 'Terreno',
                'descripcion' => 'Espacio de tierra destinado para construcción o agricultura.'
            ],
            [
                'id' => 4,
                'nombre' => 'Local Comercial',
                'descripcion' => 'Propiedad destinada a fines comerciales, como tiendas o oficinas.'
            ],
            [
                'id' => 5,
                'nombre' => 'Oficina',
                'descripcion' => 'Espacio destinado para actividades laborales o comerciales.'
            ],
        ];

        TipoPropiedad::insert($tipos);
    }
}
