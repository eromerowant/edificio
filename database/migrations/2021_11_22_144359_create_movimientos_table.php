<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosTable extends Migration
{
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('codigo_identificador')->nullable();
            $table->float('monto', 9, 2);
            $table->tinyInteger('tipo')->comment('1: deuda. 2: pago');
            $table->string('status')->comment('1: confirmado. 2: por confirmar')->default(2);
            $table->dateTime('fecha_de_confirmacion')->nullable();


            $table->unsignedBigInteger('departamento_id')->nullable();
            $table->foreign('departamento_id')->references('id')->on('departamentos')->onDelete('set null');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('movimientos');
    }
}
