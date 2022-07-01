<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGestionesDescuentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gestiones_descuentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('gestion_id')->nullable()->constrained('gestiones');
            $table->text('detalles')->nullable();
            $table->smallInteger('cantidad_cuotas')->nullable();
            $table->smallInteger('por_cuotas')->nullable()->default(1);
            $table->decimal('monto_desc', 10, 2)->nullable();
            $table->decimal('porcentaje_desc', 10, 2)->nullable();
            $table->string('estado')->nullable()->default('activo');
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
        Schema::dropIfExists('gestiones_descuentos');
    }
}
