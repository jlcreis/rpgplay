@extends('layouts.app') 
@section('content')

<div class="container">
        <div class="row">
            <div class="col">
                <h1 class="display-4">Meus personagens</h1>
            </div>
            <div class="col">
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
    @if($personagens)
        <ul class="list-group">
            @foreach($personagens as $personagem)
            <li class="list-group-item">
                <a href="{{ route('importarPersonagem',[$personagem->id, $id_partida])}}" class="list-group-item-action">
                    <div class="row">
                        <div class="col-md-2">
                            <img class="rounded-circle" src="/img/personagem/{{$personagem->avatar}}" width="75" heigth="75"  alt="avatar">
                        </div>
                        <div class="col-md-10">
                            <p><strong>{{$personagem->nome}}</strong></p>
                            <p class="card-text textSmall" style="word-spacing: 4px;">Força: {{$personagem->pontos_forca}}; 
                              Destreza: {{$personagem->pontos_destreza}}; 
                              Constituição: {{$personagem->pontos_constituicao}}; 
                              Inteligência: {{$personagem->pontos_inteligencia}}; 
                              Sabedoria: {{$personagem->pontos_sabedoria}}; 
                              Carisma: {{$personagem->pontos_carisma}}; 
                              Vida: {{$personagem->pontos_vida}};</p>
                        </div>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
    @endif

</div>

@endsection