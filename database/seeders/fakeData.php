<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class fakeData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permisos')->insert([
            ["permiso" => "Ver Usuarios", "created_at" => Carbon::now()],
            ["permiso" => "Crear Usuarios", "created_at" => Carbon::now()],
            ["permiso" => "Editar Usuario", "created_at" => Carbon::now()],
            ["permiso" => "Eliminar Usuario", "created_at" => Carbon::now()],
        ]);

        DB::table('roles')->insert([
            ['nombre' => 'Administrador', "created_at" => Carbon::now()],
            ['nombre' => 'Invitado', "created_at" => Carbon::now()],
        ]);

        DB::table('roles_permisos')->insert([
            ['role_id' => 1, 'permiso_id' => 1],
            ['role_id' => 1, 'permiso_id' => 2],
            ['role_id' => 1, 'permiso_id' => 3],
            ['role_id' => 1, 'permiso_id' => 4],
            ['role_id' => 2, 'permiso_id' => 1],
        ]);

        DB::table('usuarios')->insert([
            ['nombre' => 'Reinaldo', 'apellido' => 'Marin', 'correo' => 'prueba@gmail.com', 'password' => Hash::make(12345), 'telefono' => '584121234567', 'role_id' => 2, "created_at" => Carbon::now()],
            ['nombre' => 'Rosaura', 'apellido' => 'Larez', 'correo' => 'prueba2@gmail.com', 'password' => Hash::make(12345), 'telefono' => '584121234568', 'role_id' => 2, "created_at" => Carbon::now()],
            ['nombre' => 'Jose', 'apellido' => 'Calderin', 'correo' => 'prueba3@gmail.com', 'password' => Hash::make(12345), 'telefono' => '584161234561', 'role_id' => 2, "created_at" => Carbon::now()],
            ['nombre' => 'Mariana', 'apellido' => 'Ruiz', 'correo' => 'prueba4@gmail.com', 'password' => Hash::make(12345), 'telefono' => '584141234562', 'role_id' => 1, "created_at" => Carbon::now()],
            ['nombre' => 'Agustin', 'apellido' => 'Marcano', 'correo' => 'prueba5@gmail.com', 'password' => Hash::make(12345), 'telefono' => '584261234561', 'role_id' => 1, "created_at" => Carbon::now()],
        ]);
    }
}
