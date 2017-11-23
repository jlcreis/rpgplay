@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <div class="card">
                <div class="card-block">


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


                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-block">

                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card">
                <div class="card-block">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('post-script')
<script type="text/javascript">
    
</script>
@endsection
