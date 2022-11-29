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
            $table->foreignId('direccion')->nullable()->constrained('direcciones')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('coordinacion')->nullable()->constrained('coordinaciones')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('instituto')->nullable();
            $table->integer('año');
            $table->integer('folder')->unique();
            $table->string('responsable');
            $table->foreignId('recibido')->constrained('users')->cascadeOnUpdate();
            $table->date('fecha');
            $table->char('color',50)->nullable();
            $table->string('observaciones')->nullable();
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
