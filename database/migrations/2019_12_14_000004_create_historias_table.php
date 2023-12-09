<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historias', function (Blueprint $table) {
            $table->id();
            $table->integer('id_profesional');
            $table->integer('id_paciente');
            $table->string('inf_relevante');
            $table->string('consecutivo');
            $table->integer('estado'); // 0 activo, 1 desactivado
            $table->string('inf_antecedentes');
            $table->string('evolucion_final');
            $table->string('concepto_profesional');
            $table->string('recomendaciones');
            $table->date('fecha');
            $table->time('hora');
            $table->string('imagen')->nullable();
            $table->integer('firma')->nullable();
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
        Schema::dropIfExists('historias');
    }
}
