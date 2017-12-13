<?php

namespace App\Http\Controllers;

use Auth;
use App\Jogador;
use App\AcaoPartida;
use App\PersonagemPartida;
use Illuminate\Http\Request;

class JogarController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_partida) {

        $partida = \App\Partida::find($id_partida);
        if ($partida->status == 1) {
            \App\Partida::find($id_partida)->update(['status'=>2]);
        }
        $personagens = \App\PersonagemPartida::where([['id_partida',$id_partida],['id_usuario',Auth::user()->id]])->get();
        $personagensJogadores = \App\PersonagemPartida::where([['id_partida',$id_partida],['id_usuario','<>',$partida->id_usuario],['id_usuario','<>',Auth::user()->id]])->get();
        $personagensNPC = \App\PersonagemPartida::where([['id_partida',$id_partida],['id_usuario',$partida->id_usuario]])->get();
        
        return view('jogar.index_narrador', compact('personagens','personagensJogadores','id_partida','partida','personagensNPC'));
       
    }

    public function statusPartida(Request $request) {
        
        // partida iniciada
        if ($request->status == 2) {
            \App\Partida::find($request->id_partida)->update(['status'=>2]);
           
        }
        // partida pausada
        if ($request->status == 3) {
            \App\Partida::find($request->id_partida)->update(['status'=>3]);
            
        }
        // partida finalizada
        if ($request->status == 4) {
            \App\Partida::find($request->id_partida)->update(['status'=>4]);

        }

    }

    public function acao($id_partida, Request $request) {
        
        $partida = \App\Partida::find($id_partida);
        $acaoPartida = new AcaoPartida();
        $personagemPartida = \App\PersonagemPartida::where([['id_partida',$id_partida],['id_usuario',Auth::user()->id]])->get();
        $acaoPartida->id_partida = $id_partida;
        if (Auth::user()->id == $partida->id_usuario) {
            $acaoPartida->personagem = Auth::user()->nome;
        } else {
            $acaoPartida->personagem = Auth::user()->nome;
        }
        $acaoPartida->acao = $request->acao;
        $acaoPartida->resultado = $request->resultado;
        $acaoPartida->save();

        return response()->json($acaoPartida);
    }

    public function historicoAcoes(Request $request) {

        if (empty($request->idAcao)) {

            $acoesPartida = \App\AcaoPartida::where([['id_partida',$request->id_partida]])->get();

        } else {

            $acoesPartida = \App\AcaoPartida::where([['id_partida',$request->id_partida],['id','>',$request->idAcao]])->get();
        }
        
        return response()->json($acoesPartida);
    }

}