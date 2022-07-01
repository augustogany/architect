<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasPagosMensualidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas_pagos_mensualidades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personas_pago_id')->nullable()->constrained('personas_pagos');
            $table->foreignId('gestion_id')->nullable()->constrained('gestiones');
            $table->smallInteger('mes')->nullable();
            $table->decimal('monto_pagado', 10, 2)->nullable();
            $table->decimal('monto_descuento', 10, 2)->nullable();
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
        Schema::dropIfExists('personas_pagos_mensualidades');
    }
}
