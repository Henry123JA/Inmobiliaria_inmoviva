<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nombre');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('total', 10, 2);
            // Agregar columna para precio_unitario si es necesario

            $table->timestamps();
        });

        //
        Schema::create('factura_articulo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('factura_id')->constrained()->onDelete('cascade');
            $table->foreignId('articulo_id')->constrained()->onDelete('cascade');
            $table->decimal('precio_unitario', 10, 2);
            $table->integer('cantidad');
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
        Schema::dropIfExists('factura_articulo');
        Schema::dropIfExists('facturas');
    }
}
