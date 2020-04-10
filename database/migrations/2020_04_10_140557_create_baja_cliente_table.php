<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBajaClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baja_clientes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('cliente_id');
            $table->date('fecha_baja');
            $table->float('monto_deuda')->default(0)->nullable();
            $table->string('detalle')->nullable();
            $table->boolean('activo')->default(1); //Indica si esa baja esta activa o ya se volvio a activar al cliente (siempre el activo de baja_cliente tiene que ser distinto de activo de cliente)
            $table->unsignedBigInteger('gimnasio_id');
            $table->unsignedBigInteger('especialidad_id');
            
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('gimnasio_id')->references('id')->on('gimnasios')->onDelete('cascade');
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
        Schema::dropIfExists('baja_clientes');
    }
}
