<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        // $admin_permissions = Permission::all();
        // Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
        // $user_permissions = $admin_permissions->filter(function ($permission) {
        //     return substr($permission->title, 0, 5) != 'user_';
        // });
        // Role::findOrFail(2)->permissions()->sync($user_permissions);




        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));

        // Asignar solo el permiso 'cliente_access' al rol de Cliente
        $cliente_permissions = Permission::where('title', 'cliente_access')->pluck('id');
        Role::findOrFail(2)->permissions()->sync($cliente_permissions);

        // Asignar solo el permiso 'empleado_access' al rol de Empleado
        $agente_permissions = Permission::where('title', 'agente_access')->pluck('id');
        Role::findOrFail(3)->permissions()->sync($agente_permissions);

        $propietario_permissions = Permission::where('title', 'propietario_access')->pluck('id');
        Role::findOrFail(4)->permissions()->sync($propietario_permissions);        
    }
}
