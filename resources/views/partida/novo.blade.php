@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="display-4">Cadastro de Partida</h1>
        </div>
    </div>
    <div class="card">
        <div class="card-block">
            <form method="POST" action="{{ route('gravarPartida') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                    <label for="nome">Nome da partida</label>
                    <input type="nome" name="nome" class="form-control" id="nome" value="{{ old('nome') }}" required>
                        @if ($errors->has('nome'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nome') }}</strong>
                            </span>
                        @endif
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="data">Data da partida</label>
                            <input type="date" name="data" class="form-control" id="data" value="{{ old('data') }}" required>
                            @if ($errors->has('data'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('data') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="hora">Hora da partida</label>
                            <input type="time" name="hora" class="form-control" id="hora" value="{{ old('hora') }}" required>
                            @if ($errors->has('hora'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('hora') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="jogadores">Jogadores</label>
                </div>
                <div class="card">
                    <div class="card-block">
                        <div class="form-group">
                            <div class="input-group">
                                <input class="form-control" type="text" id="jogador" placeholder="Pesquisar jogador">
                                <span class="input-group-btn">
                                    <button class="btn btn-secondary" type="button" onclick="removeConvite()">limpar lista</button>
                                </span>
                            </div>
                            @if (session('msg'))
                                <span class="help-block">
                                    <strong>{{ session('msg') }}</strong>
                                </span>
                            @endif
                            
                        </div>
                        <ul id="listaJogadores">
                        </ul>
                    </div>           
                </div>

                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{ route('partidas')}}" class="btn btn-secondary">Cancelar</a>         
            
            </form>
                                    
        </div>
    </div>

</div>
@endsection

@section('post-script')
<script type="text/javascript">
    
    function pesquisa() {
        $("#jogador").autocomplete({
            source: "{{route('listaJogadores')}}",
            autoFocus: true,
            select: function (event, ui) {
                event.preventDefault();
                $(this).val(ui.item.label);
                $("#idJogador").val(ui.item.value);
                var inputJogador = document.createElement("input");
                    inputJogador.setAttribute("type", "hidden");
                    inputJogador.setAttribute("name", "idJogador[]");
                    inputJogador.setAttribute("id", "idJogador[]");
                    inputJogador.setAttribute("value", ui.item.value);
                var labelJogador = document.createElement("li");
                    labelJogador.setAttribute("id", "jogador");
                var textnode = document.createTextNode(ui.item.label);
                    labelJogador.appendChild(textnode);
                document.getElementById("listaJogadores").appendChild (labelJogador);
                document.getElementById("listaJogadores").appendChild (inputJogador);
                document.getElementById("jogador").value = "";
                // $('#btn_salvarPrescricao').prop( "disabled", false);
            }
        });
    }
    $("#jogador").click(pesquisa);

    function removeConvite(){
        var elemento = document.getElementById("listaJogadores");
            while (elemento.firstChild) {
            elemento.removeChild(elemento.firstChild);
            }
    }
    
</script>
@endsection