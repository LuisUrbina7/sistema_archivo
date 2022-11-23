<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivosDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('referencia')->constrained('archivos')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('documento');
            $table->integer('folios');
            $table->string('solicitud');
            $table->boolean('ap');
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
        Schema::dropIfExists('archivos_detalles');
    }
}
