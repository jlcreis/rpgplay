<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personagem extends Model
{
    protected $table = 'personagens';
    protected $fillable = [
        'id_jogador',
        'nome',
        'avatar',
        'pontos_forca',
        'pontos_destreza',
        'pontos_constituicao',
        'pontos_inteligencia',
        'pontos_sabedoria',
        'pontos_carisma',
        'pontos_vida',
    ];

    public function jogador()
    {
        return $this->belongsTo('App\Jogador','id_jogador');
    }

    public function personagem_partida()
    {
        return $this->hasOne('App\PersonagemPartida','id_personagem');
    }
}
