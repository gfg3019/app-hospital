<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('paciente_id');
            $table->foreign('paciente_id')
                ->references('id')
                ->on('pacientes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique('paciente_id');

            $table->unsignedBigInteger('medico_id');
            $table->foreign('medico_id')
                ->references('id')
                ->on('medicos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique('medico_id');

            $table->unsignedBigInteger('hospital_id');
            $table->foreign('hospital_id')
                ->references('id')
                ->on('hospitais')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique('hospital_id');

            $table->dateTime('data');
            $table->text('diagnostico');
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
        Schema::dropIfExists('consultas');
    }
}
