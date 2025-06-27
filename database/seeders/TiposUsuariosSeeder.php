<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\TipoUsuario;

class TiposUsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
            [
                'descripcion' => 'Administrador', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ],
            [
                'descripcion' => 'Dueño', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ],
            [
                'descripcion' => 'Cliente', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ],
        ];

        foreach ($tipos as $tipo) {
            TipoUsuario::create($tipo);
        }
        
    }
}
