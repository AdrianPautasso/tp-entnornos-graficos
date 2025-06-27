<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('promociones', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('texto',200);
            $table->date('fechaDesde');
            $table->date('fechaHasta');
            $table->unsignedBigInteger('idCategoriaMinima');
            $table->string('estado',200);
            $table->json('diasSemana');
            $table->unsignedBigInteger('idLocal');

            // Claves foráneas
            $table->foreign('idCategoriaMinima')->references('id')->on('categorias_clientes')->onDelete('cascade');
            $table->foreign('idLocal')->references('id')->on('locales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promociones');
    }
};