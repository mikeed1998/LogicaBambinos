<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('categoria')->nullable();
            $table->unsignedBigInteger('subcategoria')->nullable();
            $table->string('nombre')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('frente')->nullable();
            $table->string('fondo')->nullable();
            $table->string('alto')->nullable();
            $table->text('portada')->nullable();
            $table->decimal("precio", 6, 2)->default(0.00);
            $table->decimal("anticipo", 6, 2)->default(0.00);
            $table->integer("activo")->default(1);
            $table->integer("visible")->default(1);
            $table->integer("orden")->nullable();
            $table->foreign('categoria')->references('id')->on('categorias')->onDelete('cascade');
            $table->foreign('subcategoria')->references('id')->on('subcategorias')->onDelete('cascade');
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
        Schema::dropIfExists('productos');
    }
}
