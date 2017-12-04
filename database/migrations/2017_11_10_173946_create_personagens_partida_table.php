<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonagensPartidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personagens_partida', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_partida')->unsigned();
            $table->integer('id_usuario')->unsigned();
            $table->integer('id_personagem')->unsigned();
            $table->integer('pontos_forca');
            $table->integer('pontos_destreza');
            $table->integer('pontos_constituicao');
            $table->integer('pontos_inteligencia');
            $table->integer('pontos_sabedoria');
            $table->integer('pontos_carisma');
            $table->integer('pontos_vida');
            $table->integer('tipo_personagem');

            $table->foreign('id_partida')->references('id')->on('partidas');
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('id_personagem')->references('id')->on('personagens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personagens_partida');
    }
}
