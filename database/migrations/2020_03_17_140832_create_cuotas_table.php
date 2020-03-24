<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuotas', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->float('monto_cuota')->default(0);
            $table->float('monto_pagado')->default(0);
            $table->float('monto_deuda')->default(0);
            $table->date('fecha_pago');
            $table->date('fecha_pago_realizado');
            $table->date('fecha_pago_deuda')->nullable();
            $table->boolean('saldado')->default(1);
            $table->boolean('vencido')->default(0); //Utilizo para saber porqué el cliente esta en deuda (Es decir, si la cuota esta vencida es porque se debe crear otra porque ya paso el mes)

            $table->unsignedBigInteger('gimnasio_id');
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('especialidad_id');
            
            $table->foreign('gimnasio_id')->references('id')->on('gimnasios')->onDelete('cascade');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('especialidad_id')->references('id')->on('especialidades')->onDelete('cascade');

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
        Schema::dropIfExists('cuotas');
    }
}
