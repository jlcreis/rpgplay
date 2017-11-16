@extends('layouts.app') 
@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="display-4">Personagens</h1>
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
            <a class="btn btn-primary btn-align-right" href="{{ route('criarPersonagem') }}">Novo</a>
        </div>
    </div>
    @if($personagens)
        <div class="card">
        <div class="card-block">
        <div class="row">
        @foreach($personagens as $personagem)
        <div class="col-lg-3 col-md-6">
        <div class="card">
            <button type="button" class="close text-right" data-toggle="modal" data-target="#removerPersonagem_{{$personagem->id}}Modal" arial-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
            <a style="margin: 0 auto;" href="{{ route('editarAvatarPersonagem', $personagem->avatar) }}">
            <img class="card-img-top imgPersonagem" src="\img\personagem\{{ $personagem->avatar }}" alt="Imagem personagem">
            </a>
            <div class="card-block">
                <a href="{{ route('editarPersonagem', $personagem->id) }}">
                <h4 class="card-title">{{ $personagem->nome }}</h4>
                <div class="row">
                    <div class="col">
                        <p class="card-text textSmall">Força: {{$personagem->pontos_forca}}</p>
                        <p class="card-text textSmall">Destreza: {{$personagem->pontos_destreza}}</p>
                        <p class="card-text textSmall">Constituição: {{$personagem->pontos_constituicao}}</p>
                        <p class="card-text textSmall">Inteligência: {{$personagem->pontos_inteligencia}}</p>
                    </div>
                    <div class="col">
                        <p class="card-text textSmall">Sabedoria: {{$personagem->pontos_sabedoria}}</p>
                        <p class="card-text textSmall">Carisma: {{$personagem->pontos_carisma}}</p>
                        <p class="card-text textSmall">Vida: {{$personagem->pontos_vida}}</p>
                    </div>
                </div>
                </a>
            </div>
        </div>
        </div>

        <div class="modal fade" id="removerPersonagem_{{$personagem->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="removerPersonagemModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form class="form-horizontal" method="POST" action="{{ route('deletarPersonagem',$personagem->id) }}">
                    <div class="modal-content">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <p>Desejar excluir <strong>{{ $personagem->nome }}</strong> de seus personagens?
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
        </div>
        </div>
    @endif
</div>

@endsection
