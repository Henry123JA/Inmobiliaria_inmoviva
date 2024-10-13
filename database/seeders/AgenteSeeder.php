<?php

namespace Database\Seeders;

use App\Models\Agente;
use Illuminate\Database\Seeder;

class AgenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agentes = [
            [
                'id' => 1,
                'nombre' => 'Juan Pérez',
                'correo' => 'juan.perez@inmobiliaria.com',
                'telefono' => '+591 70000001'
            ],
            [
                'id' => 2,
                'nombre' => 'María García',
                'correo' => 'maria.garcia@inmobiliaria.com',
                'telefono' => '+591 70000002'
            ],
            [
                'id' => 3,
                'nombre' => 'Carlos Rodríguez',
                'correo' => 'carlos.rodriguez@inmobiliaria.com',
                'telefono' => '+591 70000003'
            ],
            [
                'id' => 4,
                'nombre' => 'Ana López',
                'correo' => 'ana.lopez@inmobiliaria.com',
                'telefono' => '+591 70000004'
            ],
            [
                'id' => 5,
                'nombre' => 'Jorge Fernández',
                'correo' => 'jorge.fernandez@inmobiliaria.com',
                'telefono' => '+591 70000005'
            ],
        ];

        Agente::insert($agentes);
    }
}
