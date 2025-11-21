<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usos_promociones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idUsuario');
            $table->unsignedBigInteger('idPromocion');
            $table->date('fechaUso');
            $table->string('estado', 50);
            $table->timestamps();

            // Claves foráneas
            $table->foreign('idUsuario')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('idPromocion')->references('id')->on('promociones')->onDelete('cascade');

            //$table->primary(['idUsuario', 'idPromocion']); // Clave compuesta
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usos_promociones');
    }
};
