<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGimnasiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gimnasios', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('nombre')->unique();
            $table->string('calle');
            $table->integer('altura');
            $table->string('pais');
            $table->string('provincia');
            $table->string('ciudad');
            $table->boolean('estado')->default(1)->before('ciudad');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('gimnasios');
    }
}
