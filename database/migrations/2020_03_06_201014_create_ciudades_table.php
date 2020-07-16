<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCiudadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ciudades', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('nombre');
            $table->unsignedBigInteger('provincia_id');
            $table->string('lat',100)->nullable();
            $table->string('lon',100)->nullable();
            $table->boolean('fav')->default(false);
            $table->foreign('provincia_id')->references('id')->on('provincias')->onDelete('cascade');

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
        Schema::dropIfExists('ciudades');
    }
}