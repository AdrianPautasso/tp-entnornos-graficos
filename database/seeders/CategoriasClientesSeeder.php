<?php

namespace Database\Seeders;

use App\Models\CategoriaCliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class CategoriasClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
    //Inicial,
    //Medium,
    //Premium

    //['descripcion', 'nivel']
        $categorias = [
            [
                'descripcion' => 'Inicial',
                'nivel' => 1, 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ],
            [
                'descripcion' => 'Medium',
                'nivel' => 2, 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ],
            [
                'descripcion' => 'Premium',
                'nivel' => 3, 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ]
        ];

        foreach ($categorias as $categoria) {
            CategoriaCliente::create($categoria);
        }

    }
}
