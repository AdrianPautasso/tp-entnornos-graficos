<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalesTable extends Migration
{
    public function up()
    {
        Schema::create('locales', function (Blueprint $table) {
            $table->id(); // id BIGINT AUTO_INCREMENT PRIMARY KEY
            $table->string('nombre', 100);
            $table->string('ubicacion', 50);
            $table->string('rubro', 20);
            $table->unsignedBigInteger('idUsuario');
            $table->timestamps();

            // Clave foránea hacia usuarios
            $table->foreign('idUsuario')->references('id')->on('usuarios');
        });
    }

    public function down()
    {
        Schema::dropIfExists('locales');
    }
}
