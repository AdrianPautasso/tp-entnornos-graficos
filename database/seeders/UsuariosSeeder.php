<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Models\Usuario;

class UsuariosSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = [
            [
                'nombre' => 'Juan Pérez',
                'usuario' => 'juanperez',
                'email' => 'juan@example.com',
                'idTipo' => 1, // Administrador
                'idCategoriaCliente' => null,
            ],
            [
                'nombre' => 'Laura Gómez',
                'usuario' => 'lauragomez',
                'email' => 'laura@example.com',
                'idTipo' => 2, // Dueña
                'idCategoriaCliente' => null,
            ],
            [
                'nombre' => 'Carlos Díaz',
                'usuario' => 'carlosdiaz',
                'email' => 'carlos@example.com',
                'idTipo' => 3, // Cliente
                'idCategoriaCliente' => 1, // Inicial
            ],
            [
                'nombre' => 'María Suárez',
                'usuario' => 'mariasuarez',
                'email' => 'maria@example.com',
                'idTipo' => 3, // Cliente
                'idCategoriaCliente' => 3, // Premium
            ],
            [
                'nombre' => 'Lucía Fernández',
                'usuario' => 'lfernandez',
                'email' => 'lucia@example.com',
                'idTipo' => 2,
                'idCategoriaCliente' => null,
            ],
            [
                'nombre' => 'Carlos Méndez',
                'usuario' => 'cmendez',
                'email' => 'carlos@example.com',
                'idTipo' => 2,
                'idCategoriaCliente' => null,
            ],
            [
                'nombre' => 'Laura Benítez',
                'usuario' => 'lbenitez',
                'email' => 'laura@example.com',
                'idTipo' => 2,
                'idCategoriaCliente' => null,
            ],
                        [
                'nombre' => 'Carla Veza',
                'usuario' => 'carlaveza',
                'email' => 'carla@example.com',
                'idTipo' => 3, // Cliente
                'idCategoriaCliente' => 3, // Premium
            ],
                        [
                'nombre' => 'Adrián Pautasso',
                'usuario' => 'adrianpautasso',
                'email' => 'adrian@example.com',
                'idTipo' => 3, // Cliente
                'idCategoriaCliente' => 2, // Medium
            ],
                        [
                'nombre' => 'Lorenzo Lischetti',
                'usuario' => 'lorenzolischetti',
                'email' => 'lorenzo@example.com',
                'idTipo' => 3, // Cliente
                'idCategoriaCliente' => 2, // Medium
            ],
                        [
                'nombre' => 'Eugenia Bortolotto',
                'usuario' => 'eugeniabortolotto',
                'email' => 'eugenia@example.com',
                'idTipo' => 3, // Cliente
                'idCategoriaCliente' => 1, // Inicial
            ],
        ];

        foreach ($usuarios as $data) {
            Usuario::create([
                'nombre' => $data['nombre'],
                'usuario' => $data['usuario'],
                'email' => $data['email'],
                'password' => Hash::make($data['usuario']),
                'idTipo' => $data['idTipo'],
                'idCategoriaCliente' => $data['idTipo'] === 3 ? $data['idCategoriaCliente'] : null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
