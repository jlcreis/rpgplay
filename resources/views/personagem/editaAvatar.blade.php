@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-block">
            <h4 class="card-title">Novo avatar</h4>
            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{route('atualizarAvatarPersonagem',$avatar) }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                    <label for="avatar" class="col-md-12 control-label">Avatar</label>
                    <div class="col-md-12">
                        <input id="avatar" type="file" class="form-control-file" name="avatar" value="" required autofocus>
                        <small id="fileHelp" class="form-text text-muted">Coloque uma imagem para seu personagem.</small>
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
                        <a href="{{ route('personagens')}}" class="btn btn-block btn-secondary">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
    