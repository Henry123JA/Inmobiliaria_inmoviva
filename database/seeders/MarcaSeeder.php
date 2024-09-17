<?php

namespace Database\Seeders;

use App\Models\marca;
use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marcs = [
            [
               'id'  => 100,
               'nombre' => 'Valvoline',
               'creacion' => '1866-01-01',
               'imagen'=>'public/imagenes/marcas'
            ],
   
            [
               'id'  => 101,
               'nombre' => 'Brembo',
               'creacion' => '1961-05-15',
               'imagen'=>'public/imagenes/marcas'
            ],
   
            [
               'id'  => 102,
               'nombre' => 'Ohlins',
               'creacion' => '1976-03-10',
                'imagen'=>'public/imagenes/marcas'
            ],
   
            [
               'id'  => 103,
               'nombre' => 'Mann-Filter',
               'creacion' => '1941-04-10',
                 'imagen'=>'public/imagenes/marcas'
            ],
   
            [
               'id'  => 104,
               'nombre' => 'Philips',
               'creacion' => '1891-02-01',
                 'imagen'=>'public/imagenes/marcas'
            ],
   
            [
               'id'  => 105,
               'nombre' => 'DID',
               'creacion' => '1866-05-23',
                'imagen'=>'public/imagenes/marcas'
            ],
   
            [
               'id'  => 106,
               'nombre' => 'Pirelli',
               'creacion' => '1866-02-21',
             'imagen'=>'public/imagenes/marcas'
            ],
   
            [
               'id'  => 107,
               'nombre' => 'Oxford',
               'creacion' => '1866-10-04',
               'imagen'=>'public/imagenes/marcas'
            ],
   
         ];
         marca::insert($marcs);
    }
}
