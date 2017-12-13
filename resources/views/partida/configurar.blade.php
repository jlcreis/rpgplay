@extends('layouts.app') 
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1 class="display-4">{{ $partida->nome }}</h1>
        </div>
        <div class="col-md-6">
            <a class="btn btn-success btn-align-right" href="{{ route('jogar',$partida->id) }}">
                {{ $partida->status == 1 ? 'Iniciar partida' : 'Continuar partida' }}
            </a>
        </div>
    </div>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#informacoes" role="tab">Informações</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab"  href="#personagens" role="tab">Personagens</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab"  href="#jogadores" role="tab">Jogadores</a>
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="informacoes" role="tabpanel">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">Informações</h4>
                    <p>Criador da partida: {{ $partida->usuario_partida->nome }}</p>
                    <p>Data: {{ date('d/m/Y', strtotime ($partida->data)) }}</p>
                    <p>Hora: {{ date('H:i', strtotime ($partida->hora)) }}</p>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="personagens" role="tabpanel">
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Personagens</h4>
                        </div>
                        <div class="col-6 align-self-end">
                        @if($partida->id_usuario == Auth::user()->id)
                            <a class="btn btn-success btn-align-right" href="{{ route('personagemSecundario', $partida->id) }}">inserir personagem</a>
                        @endif
                        </div>
                    </div>
                    @if($personagens)
                    <div class="row">
                    @foreach($personagens as $personagem)
                        <div class="col-md-4 col-lg-3">
                            <div class="card">
                                <div class="card-block">
                                    <ul class="list-unstyled">
                                        <li><strong>{{$personagem->personagem->nome}}</strong>
                                        @if ($personagem->personagem->jogador->user->id == Auth::user()->id)
                                        <button type="button" class="close text-right" data-toggle="modal" data-target="#removerPersonagem_{{$personagem->id}}Modal" arial-label="close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        @endif
                                        </li>
                                        @if ($personagem->personagem->jogador->user->id != $partida->id_usuario)
                                        <li><small>{{ $personagem->personagem->jogador->user->nome}}</small></li>
                                        @else
                                        <li><small>Personagem secundário</small></li>   
                                        @endif
                                    </ul>
                                    <img class="imgPersonagem" src="/img/personagem/{{$personagem->personagem->avatar}}" alt="avatar">
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="removerPersonagem_{{$personagem->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="removerPersonagemModal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form class="form-horizontal" method="POST" action="{{ route('deletarPersonagemSecundario',$personagem->id) }}">
                                    <div class="modal-content">
                                    <div class="modal-body">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <p>Desejar excluir seu personagem <strong>{{ $personagem->nome }}</strong> da partida?</p>
                                        <p>Você precisa escolher um personagem para jogar.</p>
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
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="tab-pane" id="jogadores" role="tabpanel">
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Jogadores convidados</h4>
                        </div>
                        <div class="col-6 align-self-end">
                        @if ($partida->id_usuario != Auth::user()->id)
                            @empty ($statusConvite)
                            <a class="btn btn-success" href="{{ route('aceitarConvite', $partida->id) }}">aceitar convite</a>
                            <a class="btn btn-danger"  href="{{ route('recusarConvite', $partida->id) }}">recusar convite</a>
                            @endempty
                            @if ($statusConvite == 2)
                            <a class="btn btn-success" href="{{ route('aceitarConvite', $partida->id) }}">aceitar convite</a>
                            @endif
                            @if ($statusConvite == 1)
                            <a class="btn btn-danger"  href="{{ route('recusarConvite', $partida->id) }}">recusar convite</a>
                            @endif
                        @endif
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <tr class="active">
                                <th>Jogador</th>
                                <th>Status</th>
                            </tr>
                            @foreach($convites as $convite)
                            <tr>
                                <td class="active">{{ $convite->convite_usuario->nome }}</td>
                                <td class="active">
                                    @empty($convite->status)
                                    <span class="badge badge-warning">aguardando confirmação</span> 
                                    @endempty
                                    @if($convite->status == 2)
                                    <span class="badge badge-danger">recusado</span> 
                                    @endif
                                    @if($convite->status == 1)
                                    <span class="badge badge-success">confirmado</span> 
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    

</div>

@endsection