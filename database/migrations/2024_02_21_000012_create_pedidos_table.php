<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('domicilio')->nullable();
            $table->unsignedBigInteger('usuario')->nullable();
            $table->unsignedBigInteger('vendedor')->nullable();
            $table->string('uid')->nullable();
            $table->integer('estatus')->default(0);
            $table->string('guia')->nullable();
            $table->text('linkguia')->nullable();
            $table->text('factura')->nullable();
            $table->integer('cantidad')->nullable();
            $table->decimal("importe", 9, 2)->default(0.00);
            $table->decimal("iva", 9, 2)->default(0.00);
            $table->decimal("total", 9, 2)->default(0.00);
            $table->decimal("envio", 9, 2)->default(0.00);
            $table->text('comprobante')->nullable();
            $table->text('cupon')->nullable();
            $table->integer('cancelado')->nullable();
            $table->text('data')->nullable();
            $table->text('envia_resp')->nullable();
            $table->foreign('domicilio')->references('id')->on('domicilios')->onDelete('cascade');
            $table->foreign('usuario')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('vendedor')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('pedidos');
    }
}
