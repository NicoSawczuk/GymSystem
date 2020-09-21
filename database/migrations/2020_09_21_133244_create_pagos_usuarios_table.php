<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos_usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('monto_pago')->nullable();
            $table->string('tipo_pago')->nullable();
            $table->string('detalle')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cuotas_usuarios_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cuotas_usuarios_id')->references('id')->on('cuotas_usuarios')->onDelete('cascade');

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
        Schema::dropIfExists('pagos_usuarios');
    }
}
