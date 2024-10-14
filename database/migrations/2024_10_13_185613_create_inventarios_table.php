<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('propiedad_id');
            $table->unsignedBigInteger('tipopropiedad_id');
            $table->unsignedBigInteger('agente_id');

            $table->date('fecha');
            $table->string('direccion');
            $table->decimal('precio');
            $table->string('estado');
            $table->string('superficie');
            $table->integer('habitaciones');
            $table->integer('baños');
            $table->string('descripcion');
            $table->string('imagen');
            
            $table->foreign('propiedad_id')->references('id')->on('propiedades')->onDelete('cascade');
            $table->foreign('tipopropiedad_id')->references('id')->on('tipo_propiedads')->onDelete('cascade');
            $table->foreign('agente_id')->references('id')->on('agentes')->onDelete('cascade');
        

            $table->timestamps();

            // Claves foráneas
           

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventarios');
    }
}
