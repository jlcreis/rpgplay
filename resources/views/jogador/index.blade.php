@extends('layouts.app') 
@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="display-4">Jogadores</h1>
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
    </div>
    @if($jogadores)
        <ul class="list-group">
            @foreach($jogadores as $jogador)
            <li class="list-group-item">
                <a href="{{route('jogador',$jogador->id)}}" class="list-group-item-action">
                    <div class="row">
                        <div class="col-md-2">
                            <img class="rounded-circle" src="/img/jogador/{{$jogador->avatar}}" width="75" heigth="75"  alt="avatar">
                        </div>
                        <div class="col-md-10">
                            <p>Usuário: <strong>{{$jogador->user->nome}}</strong></p>
                            <p>Data de Nascimento: {{date('d/m/Y', strtotime ($jogador->dt_nascimento))}}</p>
                        </div>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
    @endif
</div>

@endsection
