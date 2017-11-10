<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcaoPartida extends Model
{
    protected $table = 'acoes_partida';
    protected $fillable = [
        'id_partida',
        'jogador',
        'acao',
    ];
    
    public function status_partida()
    {
        return $this->belongsTo('App\StatusPartida','status_partida');
    }
}
