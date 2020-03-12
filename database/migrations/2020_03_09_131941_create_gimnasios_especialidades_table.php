<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGimnasiosEspecialidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gimnasios_especialidades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('gimnasio_id');
            $table->unsignedBigInteger('especialidad_id');
            $table->float('monto')->default(0);

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
        Schema::dropIfExists('gimnasios_especialidades');
    }
}
