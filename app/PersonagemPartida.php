<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonagemPartida extends Model
{
    protected $table = 'personagens_partida';

    protected $fillable = [
        'id_partida',
        'id_usuario',
        'id_personagem',
        'pontos_forca',
        'pontos_destreza',
        'pontos_constituicao',
        'pontos_inteligencia',
        'pontos_sabedoria',
        'pontos_carisma',
        'pontos_vida',
        'tipo_personagem',
    ];

    public $timestamps = false;

    public function personagem()
    {
        return $this->belongsTo('App\Personagem','id_personagem');
    }

    public function partida()
    {
        return $this->belongsTo('App\Partida','id_partida');
    }
}
