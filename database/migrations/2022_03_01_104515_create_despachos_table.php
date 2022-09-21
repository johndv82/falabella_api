<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDespachosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despachos', function (Blueprint $table) {
            $table->id();
            $table->integer("cliente_id");
            $table->integer("direccion_id");
            $table->boolean("envio_domicilio");
            $table->date("fecha_despacho");
            $table->integer("cod_tienda_retiro");
            $table->integer("estado_despacho"); // 1-Activo, 0-Inactivo, 2-Finalizado
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
        Schema::dropIfExists('despachos');
    }
}
