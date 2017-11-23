<?php

namespace App\Http\Controllers;

use Auth;
use App\Jogador;
use App\PersonagemPartida;
use Illuminate\Http\Request;

class JogarController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_partida)
    {
        $partida = \App\Partida::find($id_partida);
        if(Auth::user()->id != $partida->id_usuario) {
            return view('jogar.index_narrador');
        } else {
            $personagem->personagem->jogador->user->id == Auth::user()->id
            $personagens = \App\PersonagemPartida::where([['id_partida',$id_partida],['id_personagem',Auth::user()->jogador->personagem->id]])->get();
            
            return view('jogar.index_personagem', compact('personagens'));
        }
    }

}