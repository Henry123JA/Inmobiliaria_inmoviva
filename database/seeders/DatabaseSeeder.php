<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([

            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            MarcaSeeder::class,
            propiedadSeeder::class,
            // Registrar el seeder de Agentes
            AgenteSeeder::class,
            TipoPropiedadSeeder::class,
            //   ArticuloSeeder::class,          
        ]);
    }
}
