<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 312);
            $table->string('apaterno', 312);
            $table->string('amaterno', 312);
            $table->string('numeroregistro', 20);
            $table->string('telefonodomicilio', 50)->nullable();
            $table->string('telefonooficina', 50)->nullable();
            $table->string('telefonocelular', 50)->nullable();
            $table->string('direccion', 312)->nullable();
            $table->string('correo', 312)->nullable();
            $table->boolean('condicion')->default(1);
            $table->string('estado', 13)->default('ACTIVO');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
