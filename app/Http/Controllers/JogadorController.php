<?php

namespace App\Http\Controllers;

use App\Jogador;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Auth;

class JogadorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jogadores = \App\Jogador::all();
        
        return view('jogador.index', compact('jogadores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Jogador $jogador)
    {       
        $validator = Validator::make($request->all(), $jogador->rules, $jogador->mensagens_error);
        if($validator->fails()){
            
            return redirect()->back()->withErrors($validator)->withInput()->with('msg','teste');
        }
        $avatar = $this->moveAvatar($request->avatar);
        $jogador = new Jogador();
        $jogador->id_usuario = Auth::user()->id;
        $jogador->dt_nascimento = $request->input('dt_nascimento');
        $jogador->avatar = $avatar;
        $jogador->save();

        return redirect()->route('home')->with('msg_ok','Tarefa realizada com sucesso!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jogador = \App\Jogador::find($id);
        if(empty($jogador)){
            return view('jogador.novo');
        }
        return view('jogador.jogador', compact('jogador'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jogador $jogador, $id)
    {
        if(isset($request->avatar)){
            $validator = Validator::make($request->all(), [
                'avatar'=>'image|max:1000|mimes:jpeg,bmp,png',
            ]);
            if($validator->fails()){
                return redirect()->route('jogador',$id)
                    ->with('msg_erro','Não foi possível alterar seu avatar.');
            }
            $jog = \App\Jogador::find($id);
            $fileName = $jog->avatar;
            $this->removeAvatar($fileName);
            $avatar = $this->moveAvatar($request->avatar);
            \App\Jogador::find($id)->update(['avatar'=>$avatar]);
        }
        
        if(isset($request->nome)){
            $validator = Validator::make($request->all(),[
                'nome' => 'required|string|email|max:255|unique:users',
            ]);
            if($validator->fails()){
                return redirect()->route('jogador',$id)
                    ->with('msg_erro','Não foi possível alterar seu nome.');
            }
            \App\User::find($id)->update(['nome'=>$request->nome]);
        }

        if(isset($request->email)){
            $validator = Validator::make($request->all(),[
                'email' => 'required|string|max:20',
            ]);
            if($validator->fails()){
                return redirect()->route('jogador',$id)
                    ->with('msg_erro','Não foi possível alterar seu e-mail.');
            }
            \App\User::find($id)->update(['email'=>$request->email]);
        }

        if(isset($request->dt_nascimento)){
            $validator = Validator::make($request->all(), [
                'dt_nascimento'=>'required|date|date_format:"Y-m-d"|date|before:now',
            ]);
            if($validator->fails()){
                return redirect()->route('jogador',$id)
                    ->with('msg_erro','Não foi possível alterar sua data de nascimento.');
            }
            \App\Jogador::find($id)->update(['dt_nascimento'=>$request->dt_nascimento]);
        }
        
        return redirect()->route('jogador', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jogador = \App\Jogador::find($id);
        $avatar = $jogador->avatar;
        $id_usuario = $jogador->id_usuario;
        $this->removeAvatar($avatar);
        \App\Jogador::destroy($id);
        \App\User::destroy($id_usuario);

        return redirect()->route('jogadores')->with('msg_ok','Jogador excluido com sucesso!');
    }

    /**
     * Move imagem para repositório do servidor.
     *
     */
    public function moveAvatar($avatar)
    {
        $destinationPath = 'img/jogador';
        $fileName = md5(uniqid(time())).'.jpg';
        $avatar->move($destinationPath, $fileName);

        return $fileName;
    }

    /**
     * Remove imagem do repositório do servidor.
     *
     */
    public function removeAvatar($fileName)
    {
        unlink("img/jogador/".$fileName);
    }
}
