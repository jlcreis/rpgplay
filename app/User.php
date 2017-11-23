<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function jogador()
    {
        return $this->hasOne('App\Jogador','id_usuario');
    }

    public function partida()
    {
        return $this->hasOne('App\Partida','id_usuario');

    }

    public function convite()
    {
        return $this->hasOne('App\Convite','id_usuario');
    }
}
