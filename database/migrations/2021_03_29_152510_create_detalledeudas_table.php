<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalledeudasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalledeudas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('deuda_id')->unsigned();
            $table->unsignedBigInteger('mese_id')->unsigned()->nullable();
            $table->decimal('preciomes', 11, 2)->nullable();
            $table->string('observacioncuota', 812)->nullable();
            $table->date('fechapagomes');
            $table->decimal('totalbs', 11, 2);
            $table->string('clientIP', 15)->nullable();
            $table->string('clientIP_update', 15)->nullable();
            $table->boolean('condicion')->default(1);
            $table->timestamps();

            $table->foreign('deuda_id')->references('id')->on('deudas');
            $table->foreign('mese_id')->references('id')->on('meses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalledeudas');
    }
}
