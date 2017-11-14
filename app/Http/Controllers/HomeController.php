<?php

namespace App\Http\Controllers;

use Auth;
use App\Jogador;
use Illuminate\Http\Request;

class HomeController extends Controller
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
    public function index()
    {
        $jogador = \App\Jogador::where('id_usuario','=',Auth::user()->id)->get();
        if($jogador->isEmpty()){
            return view('jogador.novo');
        }
        return view('home');
    }
}
