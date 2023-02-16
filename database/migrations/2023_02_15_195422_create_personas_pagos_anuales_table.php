<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasPagosAnualesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas_pagos_anuales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('sucursal_id')->nullable()->constrained('sucursals');
            $table->foreignId('persona_id')->nullable()->constrained('personas');
            $table->foreignId('gestion_id')->nullable()->constrained('gestiones');
            $table->date('fecha_pago')->nullable();
            $table->decimal('monto_pagado', 10, 2)->nullable();
            $table->decimal('monto_descuento', 10, 2)->nullable();
            $table->text('observacion')->nullable();
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
        Schema::dropIfExists('personas_pagos_anuales');
    }
}
