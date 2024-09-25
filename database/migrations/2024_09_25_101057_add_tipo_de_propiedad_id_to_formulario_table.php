<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipoDePropiedadIdToFormularioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('formulario', function (Blueprint $table) {
            $table->unsignedBigInteger('tipo_de_propiedad_id')->nullable(); // Si es opcional
            $table->foreign('tipo_de_propiedad_id')->references('id')->on('tipo_propiedads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('formulario', function (Blueprint $table) {
            $table->dropForeign(['tipo_de_propiedad_id']);
            $table->dropColumn('tipo_de_propiedad_id');
        });
    }
}
