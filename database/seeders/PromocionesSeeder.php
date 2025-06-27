<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Promocion;
use Illuminate\Support\Carbon;

class PromocionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promociones = [
            [
                'texto' => '10% de descuento en todos los productos',
                'fechaDesde' => Carbon::now()->subDays(5)->toDateString(),
                'fechaHasta' => Carbon::now()->addDays(10)->toDateString(),
                'idCategoriaMinima' => 1, // Inicial
                'estado' => 'Aprobada',
                'diasSemana' => json_encode(['Lunes','Martes','Miercoles','Jueves','Viernes']), // Texto
                'idLocal' => 1,
            ],
            [
                'texto' => '2x1 en fragancias seleccionadas',
                'fechaDesde' => Carbon::now()->toDateString(),
                'fechaHasta' => Carbon::now()->addDays(7)->toDateString(),
                'idCategoriaMinima' => 2, // Medium
                'estado' => 'Pendiente',
                'diasSemana' => json_encode(['Sabado','Domingo']),
                'idLocal' => 2,
            ],
            [
                'texto' => 'Menú ejecutivo a precio rebajado',
                'fechaDesde' => Carbon::now()->subDays(2)->toDateString(),
                'fechaHasta' => Carbon::now()->addDays(5)->toDateString(),
                'idCategoriaMinima' => 3, // Premium
                'estado' => 'Aprobada',
                'diasSemana' => json_encode(['Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo']),
                'idLocal' => 3,
            ],
            [
                'texto' => '20% off en juguetes educativos',
                'fechaDesde' => Carbon::now()->addDays(1)->toDateString(),
                'fechaHasta' => Carbon::now()->addDays(14)->toDateString(),
                'idCategoriaMinima' => 1,
                'estado' => 'Denegada',
                'diasSemana' => json_encode(['Martes','Jueves','Sabado']),
                'idLocal' => 4,
            ],
        ];

        foreach ($promociones as $data) {
            Promocion::create([
                'texto' => $data['texto'],
                'fechaDesde' => $data['fechaDesde'],
                'fechaHasta' => $data['fechaHasta'],
                'idCategoriaMinima' => $data['idCategoriaMinima'],
                'estado' => $data['estado'],
                'diasSemana' => $data['diasSemana'],
                'idLocal' => $data['idLocal'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
