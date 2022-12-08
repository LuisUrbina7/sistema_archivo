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
            $table->foreignId('referencia')->constrained('archivos')->cascadeOnUpdate()->cascadeOnDelete();
            $table->char('documento',50);
            $table->integer('folios');
            $table->char('solicitud',50);
            $table->char('ap',50);
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
