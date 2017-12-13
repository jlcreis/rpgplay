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
            @foreach($partidas as $partida) <!-- partidas criadas -->
            <div class="card">
                <button type="button" class="close text-right" data-toggle="modal" data-target="#removerPartida_{{$partida->id}}Modal" arial-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <a href="{{ route('configurarPartida', $partida->id) }}" class="list-group-item-action">
                    <div class="card-block">
                        <h4 class="card-title">{{$partida->nome}}</h4>
                        <p><strong>Dia: </strong>{{date('d/m/Y', strtotime ($partida->data))}}, 
                        <strong>Horário: </strong>{{date('H:m', strtotime ($partida->hora))}},
                        <strong>Status: </strong>{{ $partida->status_partida->status }}</p>
                    </div>
                </a>
            </div>
            <div class="modal fade" id="removerPartida_{{$partida->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="removerPersonagemModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form class="form-horizontal" method="POST" action="{{ route('deletarPartida',$partida->id) }}">
                        <div class="modal-content">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <p>Desejar excluir a partida <strong>{{ $partida->nome }}</strong> ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                            <button type="submit" class="btn btn-danger">Sim</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </ul>
    @endif
    @isset($convites)
    <h3 class="display-6">Meus convites</h3>
        <ul class="list-group">
            @foreach($convites as $convite) <!-- partidas convidadas -->
            <div class="card">
                <a href="{{ route('configurarPartida', $convite->convite_partida->id) }}" class="list-group-item-action">
            <div class="card-block">
                <h4 class="card-title">{{$convite->convite_partida->nome}}</h4>
                <p><strong>Dia: </strong>{{date('d/m/Y', strtotime ($convite->convite_partida->data))}}, 
                <strong>Horário: </strong>{{date('H:m', strtotime ($convite->convite_partida->hora))}},
                <strong>Criador: </strong>{{ $convite->convite_partida->usuario_partida->nome }},
                <strong>Status: </strong>{{ $convite->convite_partida->status_partida->status }}</p>
            </div>
                </a>
            </div>
            @endforeach
        </ul>
    @endisset
</div>

@endsection