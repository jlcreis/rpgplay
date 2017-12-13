@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-1">
            <div class="card">
                <div class="card-block">
                    @if(Auth::user()->id == 1)
                    <button class="btn btn-success btn-md" id="continuar" onclick="continuar_jogo()" {{ ($partida->status == 2 || $partida->id_usuario != Auth::user()->id) ? 'disabled' : '' }}><i class="fa fa-play" aria-hidden="true"></i></button>                
                    <button class="btn btn-warning btn-md" id="pausar" onclick="pausar_jogo()" {{ ($partida->status == 3 || $partida->id_usuario != Auth::user()->id) ? 'disabled' : '' }}><i class="fa fa-pause" aria-hidden="true"></i></button>
                    <button class="btn btn-danger btn-md" id="Finalizar" onclick="finalizar_jogo()" {{ $partida->id_usuario != Auth::user()->id ? 'disabled' : '' }}><i class="fa fa-stop" aria-hidden="true"></i></button>                    
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-8">
            @if ( $partida->status == 3 )
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title"> Pausa para o café </h4>
                    </div>
                </div>
            @else
            <div class="card"><!-- Dados -->
                <div class="card-block">
                    <h4 class="card-title">Dados</h4>
                    <div class="card">
                        <div class="row">
                            <div class="col-md">
                            <div class="card-block">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button class="btn btn-secondary" id="somar" onclick="jogar_d4()">d4</button>
                                    <button class="btn btn-secondary" id="somar" onclick="jogar_d6()">d6</button>
                                    <button class="btn btn-secondary" id="somar" onclick="jogar_d8()">d8</button>
                                    <button class="btn btn-secondary" id="somar" onclick="jogar_d10()">d10</button>
                                    <button class="btn btn-secondary" id="somar" onclick="jogar_d12()">d12</button>
                                    <button class="btn btn-secondary" id="somar" onclick="jogar_d20()">d20</button>
                                    <button class="btn btn-secondary" id="somar" onclick="jogar_d100()">d100</button>
                                </div>
                            </div>
                            </div>
                            <div class="col-md">
                            <div class="card-block">
                                <h4 class="card-title" id="resultado">Resultado: </h4>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="card"><!-- Abas -->
                <div class="card-block">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        @if($partida->id_usuario != Auth::user()->id)
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#personagens" role="tab">Meu personagem</a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link {{$partida->id_usuario == Auth::user()->id ? 'active' : ''}}" data-toggle="tab" href="#jogadores" role="tab">Jogadores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#NPCs" role="tab">NPCs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Aba 4</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        @if($partida->id_usuario != Auth::user()->id)
                        <div class="tab-pane active" id="personagens" role="tabpanel"><!-- aba personagens -->
                            <div class="card">
                                <div class="card-block">
                                    @foreach($personagens as $personagem)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img class="rounded-circle" src="/img/personagem/{{$personagem->personagem->avatar}}" width="75" heigth="75"  alt="avatar">
                                            </div>
                                            <div class="col-md-10">
                                                <h4 class="card-title">{{ $personagem->personagem->nome }} <small>({{ $personagem->personagem->jogador->user->nome}})</small></h4>
                                                <p class="card-text textSmall" style="word-spacing: 4px;">Força: {{$personagem->pontos_forca}}; 
                                                Destreza: {{$personagem->pontos_destreza}}; 
                                                Constituição: {{$personagem->pontos_constituicao}}; 
                                                Inteligência: {{$personagem->pontos_inteligencia}}; 
                                                Sabedoria: {{$personagem->pontos_sabedoria}}; 
                                                Carisma: {{$personagem->pontos_carisma}}; 
                                                Vida: {{$personagem->pontos_vida}};</p>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="tab-pane {{$partida->id_usuario == Auth::user()->id ? 'active' : ''}}" id="jogadores" role="tabpanel"><!-- aba jogadores -->
                            <div class="card">
                                <div class="card-block">
                                    @foreach($personagensJogadores as $personagem)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img class="rounded-circle" src="/img/personagem/{{$personagem->personagem->avatar}}" width="75" heigth="75"  alt="avatar">
                                            </div>
                                            <div class="col-md-10">
                                                <h4 class="card-title">{{ $personagem->personagem->nome }} <small>({{ $personagem->personagem->jogador->user->nome}})</small></h4>
                                                <p class="card-text textSmall" style="word-spacing: 4px;">Força: {{$personagem->pontos_forca}}; 
                                                Destreza: {{$personagem->pontos_destreza}}; 
                                                Constituição: {{$personagem->pontos_constituicao}}; 
                                                Inteligência: {{$personagem->pontos_inteligencia}}; 
                                                Sabedoria: {{$personagem->pontos_sabedoria}}; 
                                                Carisma: {{$personagem->pontos_carisma}}; 
                                                Vida: {{$personagem->pontos_vida}};</p>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="NPCs" role="tabpanel"><!-- aba 3 -->
                            <div class="card">
                                <div class="card-block">
                                    @foreach($personagensNPC as $personagem)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img class="rounded-circle" src="/img/personagem/{{$personagem->personagem->avatar}}" width="75" heigth="75"  alt="avatar">
                                            </div>
                                            <div class="col-md-10">
                                                <h4 class="card-title">{{ $personagem->personagem->nome }}</h4>
                                                <p class="card-text textSmall" style="word-spacing: 4px;">Força: {{$personagem->pontos_forca}}; 
                                                Destreza: {{$personagem->pontos_destreza}}; 
                                                Constituição: {{$personagem->pontos_constituicao}}; 
                                                Inteligência: {{$personagem->pontos_inteligencia}}; 
                                                Sabedoria: {{$personagem->pontos_sabedoria}}; 
                                                Carisma: {{$personagem->pontos_carisma}}; 
                                                Vida: {{$personagem->pontos_vida}};</p>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="settings" role="tabpanel"><!-- aba 4 -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-block scroll-acao">
                    <div id="acoes">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('post-script')
<script type="text/javascript">
    
    $(document).ready(function() {
        historicoAcoes();
    });

    function valorDado(min,max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    function acao (acao,resultado) {
        $.ajax({
            url:'{{ route("acao",$id_partida) }}',
            type:'POST',
            data:{acao:acao,resultado:resultado},
            headers:{
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            dataType:'JSON',
            error: function() {
             alert("Servidor não está respondendo.");
           }
        });
    }

    function resultadoDados(resultado){
        var label = document.createElement("span");
        var textnode = document.createTextNode('Resultado: '+resultado);
            label.appendChild(textnode);
        var list = document.getElementById("resultado");
        if (list.hasChildNodes()) {
            list.removeChild(list.childNodes[0]);
        }
        document.getElementById("resultado").appendChild (label);
    }

    var ultimoId = 0;         
    function historicoAcoes() {
        $.ajax({
            url:'{{ route("historicoAcoes") }}',
            type:'POST',
            data:{ id_partida:{{ $id_partida }}, idAcao:ultimoId },
            headers:{
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            dataType:'JSON',
            success:function (data) {
                data.forEach ( function (acao) {
                    if (ultimoId < acao.id) {
                        ultimoId = acao.id;
                    }
                    $("#acoes").prepend('<li><strong>'+acao.personagem+'</strong><p>'+acao.acao+'</p></li>');
                });
            }
        });
        timerI = setTimeout("historicoAcoes()",1000);
        timeR = true;
    }
    
	function jogar_d4() {
		var d4 = valorDado(1,4);
        acao('Jogou um dado d4 e tirou '+d4+'.',d4);
        resultadoDados(d4);
	}
    
	function jogar_d6() {
		var d6 = valorDado(1,6);
        acao('Jogou um dado d6 e tirou '+d6+'.',d6);
        resultadoDados(d6);
	}
    
	function jogar_d8() {
		var d8 =  valorDado(1,8);
        acao('Jogou um dado d8 e tirou '+d8+'.',d8);
        resultadoDados(d8);
	}
    
	function jogar_d10() {
		var d10 =  valorDado(1,10);
        acao('Jogou um dado d10 e tirou '+d10+'.',d10);
        resultadoDados(d10);
	}
    
	function jogar_d100() {
		var d100 = valorDado(1,100);
        acao('Jogou um dado d100 e tirou '+d100+'.',d100);
        resultadoDados(d100);
	}
    
	function jogar_d20() {
		var d20 = valorDado(1,20);
        acao('Jogou um dado d20 e tirou '+d20+'.',d20);
        resultadoDados(d20);
	}
    
	function jogar_d12() {
		var d12 = valorDado(1,12);
        acao('Jogou um dado d12 e tirou '+d12+'.',d12);
        resultadoDados(d12);
	}

    function continuar_jogo() {
        $.ajax({
            url:'{{ route("statusPartida") }}',
            type:'POST',
            data:{id_partida:{{$id_partida}}, status:2},
            headers:{
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            dataType:'JSON',
            success: function (data){
            }
        });
    }

    function pausar_jogo() {
        $.post({
            url:'{{ route("statusPartida") }}',
            type:'POST',
            data:{id_partida:{{$id_partida}}, status:3},
            headers:{
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            dataType:'JSON',
            success: function (data){
            }
        });

    }

    function finalizar_jogo() {
        $.ajax({
            url:'{{ route("statusPartida") }}',
            type:'POST',
            data:{id_partida:{{$id_partida}}, status:4},
            headers:{
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            dataType:'JSON',
        });

    }

</script>
@endsection
