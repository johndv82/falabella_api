<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string("descripcion", 250);
            $table->string("codigo", 250);
            $table->string("foto", 250);
            $table->integer("marca_id");
            $table->integer("valoracion");
            $table->decimal("preciobase", 10, 2);
            $table->decimal("preciooferta", 10, 2);
            $table->decimal("preciocmr", 10, 2);
            $table->decimal("stock", 10,2);
            $table->integer("categoria_id");
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
        Schema::dropIfExists('productos');
    }
}
