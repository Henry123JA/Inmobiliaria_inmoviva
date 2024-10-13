<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Cliente;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {
        User::findOrFail(1)->roles()->sync(1);
        User::findOrFail(2)->roles()->sync(2);
        User::findOrFail(3)->roles()->sync(3);
        User::findOrFail(4)->roles()->sync(4);

        $clienteUser = User::findOrFail(2); // El usuario con el rol de cliente

        if ($clienteUser->roles->contains(2)) {
            Cliente::create([
                'user_id' => $clienteUser->id,
                'foto_frontal' => null, // Por ahora, las fotos son nulas
                'foto_trasera' => null, // Por ahora, las fotos son nulas
            ]);
        }
    }
}
