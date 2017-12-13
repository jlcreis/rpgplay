<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
    protected $table = 'partidas';
    protected $fillable = [
        'id_usuario',
        'nome',
        'data',
        'hora',
        'status',
    ];
    
    public $rules = [
        'nome'=>'required|min:3',
        'data'=>'required|date|date_format:"Y-m-d"|date|after_or_equal:today',
        'hora'=>'required|date_format:"H:i"',
        'status'=>'requered|numeric',
    ];
    
    public function usuario_partida()
    {
        return $this->belongsTo('App\User','id_usuario');
    }
    
    public function status_partida()
    {
        return $this->belongsTo('App\StatusPartida','status');
    }

    public function personagem_partida()
    {
        return $this->hasOne('App\PersonagemPartida','id_partida');
    }
    
    public function acao_partida()
    {
        return $this->hasOne('App\AcaoPartida','id_partida');
    }

    public function convite()
    {
        return $this->hasOne('App\Convite','id_partida');
    }
}
