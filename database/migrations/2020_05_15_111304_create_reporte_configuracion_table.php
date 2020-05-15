<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReporteConfiguracionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reporte_configuracion', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('titulo');
            $table->string('calle');
            $table->integer('altura');
            $table->string('ciudad');
            $table->string('provincia');
            $table->string('pais');
            $table->string('telefono');
            $table->string('logo')->nullable();

            $table->unsignedBigInteger('gimnasio_id');
            $table->foreign('gimnasio_id')->references('id')->on('gimnasios')->onDelete('cascade');

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
        Schema::dropIfExists('reporte_configuracion');
    }
}
