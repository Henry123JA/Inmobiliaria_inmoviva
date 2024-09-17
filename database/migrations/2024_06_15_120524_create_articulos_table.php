<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->integer('codigo')->unsigned(); // Evita valores negativos
            $table->string('nombre', 60);
            $table->text('imagen');
            $table->integer('precio_unitario')->unsigned(); // Evita valores negativos
            $table->integer('precio_mayor')->unsigned(); // Evita valores negativos
            $table->decimal('precio_promedio', 10, 2)->unsigned();
            $table->integer('stock')->unsigned(); // Evita valores negativos
            $table->string('descripcion', 60)->nullable();
            
            $table->unsignedBigInteger('marca_id');
            $table->timestamps();

            // Claves foráneas
            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('cascade');
        });

        /*/ Alternativamente, puedes agregar restricciones de chequeo (check constraints):
        Schema::table('articulos', function (Blueprint $table) {
            $table->check('codigo >= 0');
            $table->check('precio_unitario >= 0');
            $table->check('precio_mayor >= 0');
            $table->check('precio_promedio >= 0');
            $table->check('stock >= 0');
        });*/
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulos');
    }
}
