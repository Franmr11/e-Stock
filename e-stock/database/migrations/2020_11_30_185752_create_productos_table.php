<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id')->length(20);
            $table->string('nombre', 255)->nullable();
            $table->Integer('stock')->length(9);
            $table->bigInteger('id_empresa')->length(20);
            $table->bigInteger('id_proveedor')->length(20);
            $table->bigInteger('id_categoria')->length(20);
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
        //
    }
}
