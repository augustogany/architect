<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeudasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deudas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->unsignedBigInteger('sucursal_id')->unsigned();
            $table->unsignedBigInteger('persona_id')->unsigned();
            $table->unsignedBigInteger('tipopago_id')->unsigned();
            $table->date('fecharegistro');
            $table->integer('cuotas');
            $table->string('observacion', 812)->nullable();
            $table->string('clientIP', 15);
            $table->string('gestion', 4);
            $table->integer('cuotaspagadas');
            $table->integer('cuotasrestantes');
            $table->decimal('montodeuda', 11, 2);
            $table->decimal('montopagado', 11, 2);
            $table->decimal('montorestante', 11, 2);
            $table->boolean('condicion')->default(1);
            $table->boolean('condicion_aux')->default(1);

            $table->decimal('desc_porcent', 11, 2)->nullable();
            $table->decimal('desc_total', 11, 2)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('sucursal_id')->references('id')->on('sucursals');
            $table->foreign('persona_id')->references('id')->on('personas');
            $table->foreign('tipopago_id')->references('id')->on('tipopagos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deudas');
    }
}
