<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jogador extends Model
{
    protected $table = 'jogadores';
    protected $fillable = [
        'id_usuario','avatar', 'dt_nascimento',
    ];

    public function user()
    {
        return $this->belongsTo('App\User','id_usuario');
    }

    public function personagem()
    {
        return $this->hasOne('App\Personagem','id_jogador');
    }
}
