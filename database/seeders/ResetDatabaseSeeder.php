<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResetDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Desactivar claves foráneas para evitar errores al truncar
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Listado de tablas a vaciar (orden importante si hay FK)
        DB::table('usos_promociones')->truncate();
        DB::table('promociones')->truncate();
        DB::table('locales')->truncate();
        DB::table('usuarios')->truncate();
        DB::table('tipos_usuarios')->truncate();
        DB::table('categorias_clientes')->truncate();
        DB::table('novedades')->truncate();

        // Reactivar claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

