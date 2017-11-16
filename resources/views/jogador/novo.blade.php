@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-block">
                    <h1 class="display-4">{{ Auth::user()->nome}}</h1>
                    <p>Complete seu cadastro como jogador.</p>
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('criarJogador') }}">
                        {{ csrf_field() }}
                        
                        <div class="form-group{{ $errors->has('dt_nascimento') ? ' has-error' : '' }}">
                            <label for="dt_nascimento" class="col-md-12 control-label">Data de Nascimento</label>

                            <div class="col-md-12">
                                <input id="dt_nascimento" type="date" class="form-control" name="dt_nascimento" value="{{ old('dt_nascimento') }}" required>

                                @if ($errors->has('dt_nascimento'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dt_nascimento') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                            <label for="avatar" class="col-md-12 control-label">Avatar</label>

                            <div class="col-md-12">
                                <input id="avatar" type="file" class="form-control-file" name="avatar" value="{{ old('avatar') }}" required autofocus>
                                <small id="fileHelp" class="form-text text-muted">Coloque uma imagem para seu avatar.</small>
                                @if ($errors->has('avatar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-block btn-success">
                                    Salvar
                                </button>
                            </div>
                            </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <a class="btn btn-block btn-danger" href="{{ route('logout') }}"  onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">Sair
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection