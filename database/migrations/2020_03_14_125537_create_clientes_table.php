<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('cuil')->unique();
            $table->string('email')->unique();
            $table->date('fecha_nacimiento');
            $table->decimal('altura')->nullable();
            $table->decimal('peso')->nullable();
            $table->string('sexo');
            $table->string('ocupacion');
            $table->string('telefono')->nullable();
            $table->boolean('activo')->default(1); //Se va a usar para saber si el usuario va o no al gym


            $table->unsignedBigInteger('estado_id'); //Referencia de la tabla de estados
            $table->foreign('estado_id')->references('id')->on('estados')->onDelete('cascade');

            $table->unsignedBigInteger('especialidad_id')->nullable();
            $table->foreign('especialidad_id')->references('id')->on('especialidades')->onDelete('cascade');
            
            $table->unsignedBigInteger('gimnasio_id')->nullable();
            $table->foreign('gimnasio_id')->references('id')->on('gimnasios')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
