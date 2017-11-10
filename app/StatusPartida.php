<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusPartida extends Model
{
    protected $table = 'status_partida';
    
    protected $fillable = [
        'status',
    ];

    public $timestamps = false;
    
    public function partida()
    {
        return $this->hasOne('App\Partida','status_partida');
    }
}
