<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jogador extends Model
{
    protected $table = 'jogadores';
    protected $fillable = [
        'id_usuario','avatar', 'dt_nascimento',
    ];

    public $rules = [
        'avatar'=>'image|max:1000|mimes:jpeg,bmp,png',
        'dt_nascimento'=>'required|date|date_format:"Y-m-d"|date|before:now',
    ];
    
    public $mensagens_error =[
        'image' => 'arquivo precisa ser uma imagem.',
        'mimes' => 'escolha uma imagem no formato jpeg, bmp ou png.',
        'required' => 'data de nascimento obrigatória.',
        'date_format' => 'data inválida.',
        'date' => 'data inválida.',
        'before' => 'data inválida.'
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
