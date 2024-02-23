<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosEnviosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_envios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('telefono')->nullable();
            $table->string('RFC')->nullable();
            $table->text('calle')->nullable();
            $table->text('numero_exterior')->nullable();
            $table->text('numero_interior')->nullable();
            $table->string('pais')->nullable();
            $table->string('estado')->nullable();
            $table->string('pais')->nullable();
            $table->string('colonia')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->text('aux')->nullable();
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
        Schema::dropIfExists('datos_envios');
    }
}
