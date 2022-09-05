<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consulta_id');
            $table->dateTime('entrada');
            $table->integer('quarto');
            $table->dateTime('saida');
            $table->text('observacoes');
            $table->foreign('consulta_id')
                ->references('id')
                ->on('consultas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique('consulta_id');
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
        Schema::dropIfExists('internacoes');
    }
}
