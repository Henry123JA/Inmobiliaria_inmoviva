<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFechaEnvioToFormularioTable extends Migration
{
    public function up()
    {
        Schema::table('formulario', function (Blueprint $table) {
            $table->timestamp('fecha_envio')->nullable(); // Añade la columna fecha_envio
        });
    }

    public function down()
    {
        Schema::table('formulario', function (Blueprint $table) {
            $table->dropColumn('fecha_envio'); // Elimina la columna en caso de rollback
        });
    }
}
