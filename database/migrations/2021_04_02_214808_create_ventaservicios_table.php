<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentaserviciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventaservicios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->unsignedBigInteger('sucursal_id')->unsigned();
            $table->unsignedBigInteger('persona_id')->unsigned();
            $table->date('fecharegistro');
            $table->string('gestion', 4);
            $table->string('clientIP', 15);
            $table->decimal('totalbs', 11, 2);
            $table->string('observacion', 812)->nullable();
            $table->boolean('condicion')->default(1);
            $table->boolean('condicion_aux')->default(1);
            $table->string('estado', 13)->default('ACTIVO');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('sucursal_id')->references('id')->on('sucursals');
            $table->foreign('persona_id')->references('id')->on('personas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventaservicios');
    }
}
