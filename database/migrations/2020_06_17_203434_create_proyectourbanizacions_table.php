<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectourbanizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectourbanizacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->unsignedBigInteger('sucursal_id')->unsigned();
            $table->unsignedBigInteger('persona_id')->unsigned();
            $table->unsignedBigInteger('categoriaurbanizacion_id')->unsigned();
            $table->decimal('arancelcategoria', 11, 3)->nullable();
            $table->decimal('costo_pu_categoria', 11, 3);
            $table->decimal('porcentaje_cab_categoria', 11, 3)->nullable();
            $table->decimal('visado_sus_categoria', 11, 2)->nullable();
            $table->decimal('visado_bs_categoria', 11, 3)->nullable();
            $table->string('proyecto', 512);
            $table->string('propietario', 812);
            $table->decimal('superficiemts2', 11, 2);
            $table->decimal('totalbs', 11, 3);
            $table->decimal('descuento', 11, 3);
            $table->date('fecharegistro');
            $table->string('archivo', 999)->nullable();
            $table->boolean('condicion')->default(1);
            $table->string('estado',50)->default('pendiente');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('sucursal_id')->references('id')->on('sucursals');
            $table->foreign('persona_id')->references('id')->on('personas');
            $table->foreign('categoriaurbanizacion_id')->references('id')->on('categoriaurbanizacions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyectourbanizacions');
    }
}
