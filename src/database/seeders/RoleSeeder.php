<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'ADMIN', 'description'   => 'Administrador total del sistema.'],
            ['name' => 'OPERA', 'description'   => 'Operador, Tareas administrativas'],
            ['name' => 'DRIVER', 'description'  => 'Choferes'],
            ['name' => 'CLIENT', 'description'  => 'Clientes, Agencias o particulares'],
            ['name' => 'PAX', 'description'     => 'Pasajeros'],
            
        ];

        Role::insert($roles);
    }
}
