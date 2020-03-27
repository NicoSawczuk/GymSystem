<?php

use App\EmailConfiguracion;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailConfiguracionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_configuracion', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('destinatario')->nullable();
            $table->string('remitente');
            $table->string('asunto');
            $table->longText('contenido');
            $table->boolean('detalle_monto')->default(0);

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
        Schema::dropIfExists('email_configuracion');
    }
}
