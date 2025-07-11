<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre', 100);
            $table->string('usuario', 100);
            $table->string('email', 100);
            $table->string('password', 255); // Usamos 255 para bcrypt
            $table->unsignedBigInteger('idTipo'); // debe ser unsignedBigInteger
            $table->unsignedBigInteger('idCategoriaCliente')->nullable();

            // Opcional: índices y claves foráneas
            $table->foreign('idTipo')->references('id')->on('tipos_usuarios');
            $table->foreign('idCategoriaCliente')->references('id')->on('categorias_clientes');
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
