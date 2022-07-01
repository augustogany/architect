<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipopagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipopagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->unsignedBigInteger('sucursal_id')->unsigned();
            $table->string('nombrepago', 812);
            $table->string('gestion', 4)->nullable();
            $table->decimal('monto', 11, 2);
            $table->decimal('monto_aux', 11, 2);
            $table->decimal('descuentoporcentaje', 11, 2);
            $table->decimal('descuentobs', 11, 2);
            $table->integer('cuotas');
            $table->string('clientIP', 15);
            $table->string('clientIP_update', 15);
            $table->boolean('condicion')->default(1);
            $table->boolean('condicion_aux')->default(1);
            $table->string('estado', 13)->default('ACTIVO');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('sucursal_id')->references('id')->on('sucursals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipopagos');
    }
}
