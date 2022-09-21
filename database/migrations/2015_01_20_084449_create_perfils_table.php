<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfils', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('expedicion_id')->unsigned();
            $table->string('imagen', 100)->nullable();
            $table->string('nombre', 100)->nullable();
            $table->string('apaterno', 50)->nullable();
            $table->string('amaterno', 50)->nullable();
            $table->string('ci', 15);
            $table->string('telefono', 10);
            $table->string('direccion', 100)->nullable();
            $table->text('cv')->nullable();
            $table->boolean('condicion')->default(1);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('expedicion_id')->references('id')->on('expedicions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfils');
    }
}
