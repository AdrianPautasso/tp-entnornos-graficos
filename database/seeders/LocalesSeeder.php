<?php

namespace Database\Seeders;

use App\Models\Local;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class LocalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locales = [
            [
                'nombre' => 'Fragancia Pura',
                'ubicacion' => 'Local 1',
                'rubro' => 'Perfumería',
                'idUsuario' => 2,
            ],
            [
                'nombre' => 'Vista Clara',
                'ubicacion' => 'Local 2',
                'rubro' => 'Óptica',
                'idUsuario' => 5,
            ],
            [
                'nombre' => 'Sabor Urbano',
                'ubicacion' => 'Local 3',
                'rubro' => 'Gastronómico',
                'idUsuario' => 6,
            ],
            [
                'nombre' => 'Diversión Total',
                'ubicacion' => 'Local 4',
                'rubro' => 'Juguetería',
                'idUsuario' => 7,
            ],
        ];

        foreach ($locales as $data) {
            Local::create([
                'nombre' => $data['nombre'],
                'ubicacion' => $data['ubicacion'],
                'rubro' => $data['rubro'],
                'idUsuario' => $data['idUsuario'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
