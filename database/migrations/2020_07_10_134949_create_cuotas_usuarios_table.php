<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuotasUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuotas_usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->date('fecha_inicio');
            $table->date('fecha_vencimiento');
            $table->float('monto_cuota')->default(0);
            $table->float('monto_pagado')->default(0);
            $table->longText('detalle')->nullable();
            $table->boolean('vencido')->default(0);

            $table->unsignedBigInteger('descuento_id')->nullable();
            $table->foreign('descuento_id')->references('id')->on('descuentos');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('cuotas_usuarios');
    }
}
