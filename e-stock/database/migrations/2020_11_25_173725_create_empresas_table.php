<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id')->length(20);
            $table->bigInteger('id_usuario')->length(20);
            $table->string('nombre', 255)->unique();
            $table->string('direccion', 255);
            $table->string('telefono', 9)->nullable();
            $table->string('pais', 255)->nullable();
            $table->string('ciudad', 255)->nullable();
            $table->bigInteger('cod_postal')->length(9)->unique();
            $table->string('cif', 9)->unique();
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
