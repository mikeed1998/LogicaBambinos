<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomiciliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domicilios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('usuario')->nullable();
            $table->text('alias')->nullable();
            $table->text('calle')->nullable();
            $table->text('numero_exterior')->nullable();
            $table->text('numero_interior')->nullable();
            $table->text('pais')->nullable();
            $table->text('estado')->nullable();
            $table->text('municipio')->nullable();
            $table->text('colonia')->nullable();
            $table->text('codigo_postal')->nullable();
            $table->text('predeterminado')->nullable();
            $table->foreign('usuario')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('domicilios');
    }
}
