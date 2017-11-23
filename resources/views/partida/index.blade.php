@extends('layouts.app') 
@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="display-4">Partidas</h1>
        </div>
        <div class="col">
            @if (session('msg_ok'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p><small>{{ session('msg_ok') }}</small></p>
            </div>
            @endif
            @if (session('msg_erro'))
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p><small>{{ session('msg_erro') }}</small></p>
            </div>
            @endif
        </div>
        <div class="col align-self-end">
            <a class="btn btn-primary btn-align-right" href="{{ route('criarPartida') }}">Novo</a>
        </div>
    </div>
    
    @if($partidas)
        <ul class="list-group">
            @foreach($partidas as $partida)
            <li class="list-group-item">
                <a href="{{ route('configurarPartida', $partida->id) }}" class="list-group-item-action">
                    <p>Nome: <strong>{{$partida->nome}}</strong></p>
                    <p>Data da partida: {{date('d/m/Y', strtotime ($partida->data))}}</p>
                    <p>Hora da partida: {{date('H:m', strtotime ($partida->hora))}}</p>
                    <p>Criador: {{ $partida->usuario_partida->nome }}</p>
                    <p>Status: {{ $partida->status_partida->status }}</p>
                </a>
            </li>
            @endforeach
        </ul>
    @endif
    @if($convites)
        <ul class="list-group">
            @foreach($convites as $convite)
            <li class="list-group-item">
                <a href="{{ route('configurarPartida', $convite->convite_partida->id) }}" class="list-group-item-action">
                    <p>Nome: <strong>{{$convite->convite_partida->nome}}</strong></p>
                    <p>Data da partida: {{date('d/m/Y', strtotime ($convite->convite_partida->data))}}</p>
                    <p>Hora da partida: {{date('H:m', strtotime ($convite->convite_partida->hora))}}</p>
                    <p>Criador: {{ $convite->convite_partida->usuario_partida->nome }}</p>
                    <p>Status: {{ $convite->convite_partida->status_partida->status }}</p>
                </a>
            </li>
            @endforeach
        </ul>
    @endif
</div>

@endsection