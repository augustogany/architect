<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas_pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('sucursal_id')->nullable()->constrained('sucursals');
            $table->foreignId('persona_id')->nullable()->constrained('personas');
            $table->foreignId('ventaservicio_id')->nullable()->constrained('ventaservicios');
            $table->foreignId('proyectogeneral_id')->nullable()->constrained('proyectogenerals');
            $table->foreignId('proyectourbanizacion_id')->nullable()->constrained('proyectourbanizacions');
            $table->string('fecha_pago')->nullable();
            $table->decimal('descuento', 10, 2)->nullable();
            $table->string('observacion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas_pagos');
    }
}
