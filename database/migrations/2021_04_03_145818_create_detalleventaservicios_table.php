<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleventaserviciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleventaservicios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ventaservicio_id')->unsigned();
            $table->unsignedBigInteger('servicio_id')->unsigned();
            $table->decimal('precio', 11, 2);
            $table->decimal('cantidad', 11, 2);
            $table->decimal('descuento', 10, 2);
            $table->string('observacion', 812)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ventaservicio_id')->references('id')->on('ventaservicios');
            $table->foreign('servicio_id')->references('id')->on('servicios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalleventaservicios');
    }
}
