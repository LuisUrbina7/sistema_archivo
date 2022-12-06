<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('direccion')->constrained('direcciones')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('coordinacion')->constrained('coordinaciones')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('instituto',100)->nullable();
            $table->integer('año');
            $table->integer('folder')->unique();
            $table->char('responsable',50);
            $table->foreignId('recibido')->constrained('users')->cascadeOnUpdate();
            $table->date('fecha');
            $table->char('color',50)->nullable();
            $table->string('observaciones')->nullable();
            $table->foreignId('estante')->constrained('estantes')->cascadeOnUpdate()->cascadeOnDelete();;
            $table->foreignId('periodo')->constrained('periodos')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('archivos');
    }
}
