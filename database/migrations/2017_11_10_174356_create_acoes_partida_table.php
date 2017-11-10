<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcoesPartidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acoes_partida', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_partida')->unsigned();
            $table->string('personagem',50);
            $table->string('acao',200);
            $table->timestamps();

            $table->foreign('id_partida')->references('id')->on('partidas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acoes_partida');
    }
}
