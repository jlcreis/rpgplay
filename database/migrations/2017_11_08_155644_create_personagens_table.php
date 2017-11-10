<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personagens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_jogador')->unsigned();
            $table->string('nome',50);
            $table->string('avatar');
            $table->integer('pontos_forca');
            $table->integer('pontos_destreza');
            $table->integer('pontos_constituicao');
            $table->integer('pontos_inteligencia');
            $table->integer('pontos_sabedoria');
            $table->integer('pontos_carisma');
            $table->integer('pontos_vida');
            $table->timestamps();

            $table->foreign('id_jogador')->references('id')->on('jogadores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personagens');
    }
}
