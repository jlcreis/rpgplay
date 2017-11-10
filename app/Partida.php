<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
    protected $table = 'partidas';
    protected $fillable = [
        'nome',
        'data',
        'hora',
        'status',
    ];
    
    public function status_partida()
    {
        return $this->belongsTo('App\StatusPartida','status_partida');
    }

    public function personagem_partida()
    {
        return $this->hasOne('App\PersonagemPartida','id_partida');
    }
    
    public function acao_partida()
    {
        return $this->hasOne('App\AcaoPartida','id_partida');
    }
}
