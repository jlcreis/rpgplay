<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convite extends Model
{
    protected $table = 'convites';
    
    protected $fillable = [
        'id_partida','id_usuario', 'status',
    ];

    public function convite_partida()
    {
        return $this->belongsTo('App\Partida','id_partida');
    }

    public function convite_usuario()
    {
        return $this->belongsTo('App\User','id_usuario');
    }
}
