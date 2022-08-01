<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectogeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectogenerals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->unsignedBigInteger('sucursal_id')->unsigned();
            $table->unsignedBigInteger('persona_id')->unsigned();
            $table->unsignedBigInteger('categoriageneral_id')->unsigned();
            $table->decimal('costocategoria', 11, 2);
            $table->string('proyecto', 512);
            $table->string('propietario', 812);
            $table->decimal('superficiemts2', 11, 2);
            $table->decimal('totalbs_inicial', 11, 2)->nullable();
            $table->decimal('totalbs', 11, 2);
            $table->decimal('totalbs_aux', 11, 2)->nullable();
            $table->decimal('descuento', 11, 2);
            $table->date('fecharegistro');
            $table->string('archivo', 999)->nullable();
            $table->boolean('condicion')->default(1);
            $table->boolean('condicion_aux')->default(1);
            $table->string('estado')
                    ->nullable()
                    ->default('pendiente');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('sucursal_id')->references('id')->on('sucursals');
            $table->foreign('persona_id')->references('id')->on('personas');
            $table->foreign('categoriageneral_id')->references('id')->on('categoriagenerals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyectogenerals');
    }
}
