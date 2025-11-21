<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UsoPromocion;
use Illuminate\Support\Carbon;

class UsosPromocionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usos_promociones = [
            ['idUsuario' => 11, 'idPromocion' => 1, 'fechaUso' => Carbon::now()->subDays(5)->toDateString(), 'estado' => 'Enviada'],
            ['idUsuario' => 10,  'idPromocion' => 2, 'fechaUso' => Carbon::now()->subDays(4)->toDateString(), 'estado' => 'Aceptada'],
            ['idUsuario' => 10, 'idPromocion' => 3, 'fechaUso' => Carbon::now()->subDays(3)->toDateString(), 'estado' => 'Rechazada'],
            ['idUsuario' => 9,  'idPromocion' => 4, 'fechaUso' => Carbon::now()->subDays(2)->toDateString(), 'estado' => 'Enviada'],
            ['idUsuario' => 8,  'idPromocion' => 1, 'fechaUso' => Carbon::now()->subDay()->toDateString(), 'estado' => 'Aceptada'],
            ['idUsuario' => 4,  'idPromocion' => 2, 'fechaUso' => Carbon::now()->toDateString(), 'estado' => 'Rechazada'],
        ];

        foreach ($usos_promociones as $data) {
            UsoPromocion::create([
                'idUsuario'     => $data['idUsuario'],
                'idPromocion'   => $data['idPromocion'],
                'fechaUso'      => $data['fechaUso'],
                'estado'        => $data['estado'],
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);
        }
    }
}
