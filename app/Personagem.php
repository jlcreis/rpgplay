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
    
    public $rules = [
        'nome'=>'required|string|min:3|max:50',
        'avatar'=>'image|max:1000|mimes:jpeg,bmp,png',
        'pontos_forca'=>'required',
        'pontos_destreza'=>'required',
        'pontos_constituicao'=>'required',
        'pontos_inteligencia'=>'required',
        'pontos_sabedoria'=>'required',
        'pontos_carisma'=>'required',
        'pontos_vida'=>'required',
    ];
    
    public $mensagens_error =[
        'image' => 'arquivo precisa ser uma imagem.',
        'mimes' => 'escolha uma imagem no formato jpeg, bmp ou png.'
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
