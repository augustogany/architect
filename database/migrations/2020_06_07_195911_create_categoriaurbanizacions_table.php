<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriaurbanizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoriaurbanizacions', function (Blueprint $table) {
            $table->id();
            $table->string('mt2_inicio', 312);
            $table->string('mt2_fin', 312);
            $table->decimal('arancel', 11, 3);
            $table->decimal('costo_pu', 11, 3);
            $table->decimal('porcentaje_cab', 11, 3);
            $table->decimal('visado_sus', 11, 2);
            $table->decimal('visado_bs', 11, 3);
            $table->boolean('condicion')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categoriaurbanizacions');
    }
}
