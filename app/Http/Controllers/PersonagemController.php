<?php

namespace App\Http\Controllers;

use App\Personagem;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Auth;

class PersonagemController extends Controller
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
            $personagens = \App\Personagem::all();
        }
        else{
            $personagens = \App\Personagem::where('id_jogador',Auth::user()->jogador->id)->get();
        }
        
        return view('personagem.index', compact('personagens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view('personagem.novo');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Personagem $personagem) {

        $validator = Validator::make($request->all(), $personagem->rules, $personagem->mensagens_error);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //$usuario = \App\User::with('jogador')->find(Auth::user()->id);
        $avatar = $this->moveAvatar($request->avatar);

        $personagem = new Personagem();
        //$personagem->id_jogador = $usuario->jogador->id;
        $personagem->id_jogador = Auth::user()->jogador->id;
        $personagem->nome = $request->input('nome');
        $personagem->avatar = $avatar;
        $personagem->pontos_forca = $request->input('pontos_forca');
        $personagem->pontos_destreza = $request->input('pontos_destreza');
        $personagem->pontos_constituicao = $request->input('pontos_constituicao');
        $personagem->pontos_inteligencia = $request->input('pontos_inteligencia');
        $personagem->pontos_sabedoria = $request->input('pontos_sabedoria');
        $personagem->pontos_carisma = $request->input('pontos_carisma');
        $personagem->pontos_vida = $request->input('pontos_vida');
        $personagem->save();
        
        return redirect()->route('personagens');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $personagem = \App\Personagem::find($id);

        return view('personagem.edita', compact('personagem'));
    }

    public function editAvatar($avatar) {

        return view('personagem.editaAvatar',compact('avatar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $validator = Validator::make($request->all(), [
            'nome'=>'required|string|min:3|max:50',
            'pontos_forca'=>'required',
            'pontos_destreza'=>'required',
            'pontos_constituicao'=>'required',
            'pontos_inteligencia'=>'required',
            'pontos_sabedoria'=>'required',
            'pontos_carisma'=>'required',
            'pontos_vida'=>'required',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        \App\Personagem::where('id', $id)->update([
            'nome' => $request->nome,
            'pontos_forca'=>$request->pontos_forca,
            'pontos_destreza'=>$request->pontos_destreza,
            'pontos_constituicao'=>$request->pontos_constituicao,
            'pontos_inteligencia'=>$request->pontos_inteligencia,
            'pontos_sabedoria'=>$request->pontos_sabedoria,
            'pontos_carisma'=>$request->pontos_carisma,
            'pontos_vida'=>$request->pontos_vida
            ]);

        return redirect()->route('personagens');
    }

    public function updateAvatar(Request $request, $avatar) {

        $validator = Validator::make($request->all(), [
            'avatar'=>'image|max:1000|mimes:jpeg,bmp,png',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $destinationPath = 'img/personagem';
        $request->avatar->move($destinationPath, $avatar);

        return redirect()->route('personagens');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $personagem = \App\Personagem::find($id);
        $avatar = $personagem->avatar;
        $this->removeAvatar($avatar);
        \App\Personagem::destroy($id);

        return back();
    }
    
    /**
     * Move imagem para repositório do servidor.
     *
     */
    public function moveAvatar($avatar) {

        //$destinationPath = 'http://www.joaolcreis.96.lt/rpgplay/public/img/personagem';
        $destinationPath = 'http:/http://127.0.0.1:8000/public/img/personagem';
        $fileName = md5(uniqid(time())).'.jpg';
        $avatar->move($destinationPath, $fileName);

        return $fileName;
    }

    /**
     * Remove imagem do repositório do servidor.
     *
     */
    public function removeAvatar($fileName) {
        
        //unlink("http://www.joaolcreis.96.lt/rpgplay/public/img/personagem/".$fileName);
        unlink("http:/http://127.0.0.1:8000/public/img/personagem/".$fileName);
    }
}
