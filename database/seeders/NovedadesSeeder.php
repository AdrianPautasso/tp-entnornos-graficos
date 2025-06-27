<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Novedad;
use Illuminate\Support\Carbon;

class NovedadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $novedades = [
            [
                'texto' => 'Nueva funcionalidad de búsqueda avanzada disponible.',
                'fechaDesde' => Carbon::now()->subDays(3)->toDateString(),
                'fechaHasta' => Carbon::now()->addDays(7)->toDateString(),
                'idCategoriaMinima' => 1, // Cualquier usuario Inicial o superior
            ],
            [
                'texto' => 'Lanzamiento de la app móvil para Dueños de locales.',
                'fechaDesde' => Carbon::now()->subWeek()->toDateString(),
                'fechaHasta' => Carbon::now()->addWeek()->toDateString(),
                'idCategoriaMinima' => 2, // Solo Medium y Premium
            ],
            [
                'texto' => 'Oferta exclusiva para Clientes Premium: envío gratis.',
                'fechaDesde' => Carbon::now()->toDateString(),
                'fechaHasta' => Carbon::now()->addDays(30)->toDateString(),
                'idCategoriaMinima' => 3, // Solo Premium
            ],
        ];

        foreach ($novedades as $data) {
            Novedad::create([
                'texto' => $data['texto'],
                'fechaDesde' => $data['fechaDesde'],
                'fechaHasta' => $data['fechaHasta'],
                'idCategoriaMinima' => $data['idCategoriaMinima'], // ajusta nombre de columna si difiere
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
