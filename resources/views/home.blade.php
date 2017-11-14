@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">Home</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('personagens') }}">
                <div class="card">
                    <img class="card-img-top" src="/img/IMG002.jpg" alt="imagem personagem">
                    <div class="card-block">
                        <h4 class="card-title">Personagem</h4>
                        <p>Crie e gerencie seus personagens.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('partidas') }}">
                <div class="card">
                    <img class="card-img-top" src="/img/IMG003.jpg" alt="imagem partida">
                    <div class="card-block">
                        <h4 class="card-title">Partidas</h4>
                        <p>Vamos jogar!</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('criarPartida') }}">
                <div class="card">
                    <img class="card-img-top" src="/img/IMG004.jpg" alt="imagem criar partida">
                    <div class="card-block">
                        <h4 class="card-title">Criar Partidas</h4>
                        <p>Crie uma partida e convide seus amigos.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">Avisos</h4>
                    <ul>
                        <li>Exemplo de aviso 01</li>
                        <li>Exemplo de aviso 02</li>
                        <li>Exemplo de aviso 03</li>
                    <ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
