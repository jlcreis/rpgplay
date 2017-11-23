<?php

namespace App\Http\Controllers;

use App\Partida;
use App\PersonagemPartida;
use App\Convite;
use Illuminate\Http\Request;
use Validator;
use Auth;

class PartidaController extends Controller
{
    public function __construct() {
        
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        if(Auth::user()->id == 1){
            $partidas = \App\Partida::all();
        }
        else{
            $convites = \App\Convite::where('id_usuario',Auth::user()->id)->get();
            //dd($convites);
            $partidas = \App\Partida::where('id_usuario',Auth::user()->id)->get();

        }
        
        return view('partida.index', compact('partidas','convites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view('partida.novo');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Partida $partida) {

        $validator = Validator::make($request->all(), $partida->rules);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        if(count($request->idJogador) < 3){
            return redirect()->back()->with('msg','número de jogadores insuficiente.')->withInput();
        }
        
        $partida = new Partida();
        $partida->id_usuario = Auth::user()->id;
        $partida->nome = $request->nome;
        $partida->data = $request->data;
        $partida->hora = $request->hora;
        $partida->status = 1;
        $partida->save();

        foreach($request->idJogador as $idJogador){
            $convite = new Convite();
            $convite->id_partida = $partida->id;
            $convite->id_usuario = $idJogador;
            $convite->save();
        }
        
        return redirect()->route('partidas');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
        $convite = \App\Convite::select('status')->where([['id_partida','=',$id],['id_usuario','=',Auth::user()->id]])->get();
        foreach ($convite as $c)
        {
            $statusConvite = $c->status;
        }
        $convites = \App\Convite::where('id_partida','=',$id)->get();
       
        $partida = \App\Partida::find($id);
        $personagens = \App\PersonagemPartida::where('id_partida','=',$id)->get();
        
        return view('partida.configurar', compact('partida','convites','personagens','statusConvite'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        //

    }

    /**
     * 
     */
    public function aceitarConvite($id_partida) {

        \App\Convite::where([['id_usuario','=',Auth::user()->id],['id_partida','=',$id_partida]])->update(['status'=>1]);
        $personagens = \App\Personagem::where('id_jogador',Auth::user()->jogador->id)->get();

        return view('partida.personagem_partida', compact('personagens','id_partida'))->with('partida','$id_partida');
    
    }

    /**
     * 
     */
    public function recusarConvite($id_partida) {

        $partida = \App\Partida::find($id_partida);
        $personagens = \App\PersonagemPartida::where('id_partida','=',$id_partida)->get();
        foreach ($personagens as $p) {
            if ($p->personagem->jogador->user->id != $partida->id_usuario) {
                \App\PersonagemPartida::destroy($p->id);
            }
        }

        \App\Convite::where([['id_usuario','=',Auth::user()->id],['id_partida','=',$id_partida]])->update(['status'=>2]);

        return redirect()->route('home');

    }

    /**
     * 
     */
    public function importarPersonagem($id_personagem, $id_partida) {

        $p = \App\Partida::find($id_partida);
        $d = \App\PersonagemPartida::where([['id_personagem','=',$id_personagem],['id_partida','=',$id_partida]])->get();
        
        if($d->isNotEmpty()) {
            return redirect()->route('configurarPartida', $id_partida);
        }

        $personagem = \App\Personagem::find($id_personagem);

        $personagem_partida = new PersonagemPartida();
        $personagem_partida->id_partida = $id_partida;
        $personagem_partida->id_personagem = $personagem->id;
        $personagem_partida->pontos_forca = $personagem->pontos_forca;
        $personagem_partida->pontos_destreza = $personagem->pontos_destreza;
        $personagem_partida->pontos_constituicao = $personagem->pontos_constituicao;
        $personagem_partida->pontos_inteligencia = $personagem->pontos_inteligencia;
        $personagem_partida->pontos_sabedoria = $personagem->pontos_sabedoria;
        $personagem_partida->pontos_carisma = $personagem->pontos_carisma;
        $personagem_partida->pontos_vida = $personagem->pontos_vida;
        
        if($p->id_usuario == Auth::user()->id) {
            $personagem_partida->tipo_personagem = 2;   
        } else {
            $personagem_partida->tipo_personagem = 1;
        }

        $personagem_partida->save();

        return redirect()->route('configurarPartida', $id_partida);

    }
    
    /**
     * 
     */
    public function personagemSecundario($id_partida) {

        $personagens = \App\Personagem::where('id_jogador',Auth::user()->jogador->id)->get();

        return view('partida.personagem_partida', compact('personagens','id_partida'))->with('msg_erro','teste');
    
    }

    /**
     * 
     */
    public function deletarPersonagemPartida($id) {

        \App\PersonagemPartida::destroy($id);

        return back();

    }
}
