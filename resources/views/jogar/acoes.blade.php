<!-- nao estão sendo usado -->

@if($acoesPartida)
    @foreach($acoesPartida as $acaoPartida)
    <p>{{$acaoPartida->acao}}</p>
    @endforeach
@endif