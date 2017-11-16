@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-block">
            <h4 class="card-title">Novo personagem</h4>
            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{isset($personagem) ? route('atualizarPersonagem',$personagem->id) : route('gravarPersonagem') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                    <label for="nome" class="col-md-12 control-label">Nome</label>

                    <div class="col-md-12">
                        <input id="nome" type="text" class="form-control" name="nome" value="{{ isset($personagem) ? $personagem->nome : old('nome') }}" required>

                        @if ($errors->has('nome'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nome') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="row">
                <div class="col-md-3">
                    <div class="form-group{{ $errors->has('pontos_forca') ? ' has-error' : '' }}">
                        <label for="pontos_forca" class="col-md-12 control-label">Pontos de força</label>

                        <div class="col-md-12">
                            <input id="pontos_forca" type="number" class="form-control" name="pontos_forca" value="{{ isset($personagem) ? $personagem->pontos_forca : old('pontos_forca') }}" required>

                            @if ($errors->has('pontos_forca'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pontos_forca') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('pontos_destreza') ? ' has-error' : '' }}">
                        <label for="pontos_destreza" class="col-md-12 control-label">Pontos de destreza</label>

                        <div class="col-md-12">
                            <input id="pontos_destreza" type="number" class="form-control" name="pontos_destreza" value="{{ isset($personagem) ? $personagem->pontos_destreza : old('pontos_destreza') }}" required>

                            @if ($errors->has('pontos_destreza'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pontos_destreza') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group{{ $errors->has('pontos_constituicao') ? ' has-error' : '' }}">
                        <label for="pontos_constituicao" class="col-md-12 control-label">Pontos de constituicao</label>

                        <div class="col-md-12">
                            <input id="pontos_constituicao" type="number" class="form-control" name="pontos_constituicao" value="{{ isset($personagem) ? $personagem->pontos_constituicao : old('pontos_constituicao') }}" required>

                            @if ($errors->has('pontos_constituicao'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pontos_constituicao') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group{{ $errors->has('pontos_inteligencia') ? ' has-error' : '' }}">
                        <label for="pontos_inteligencia" class="col-md-12 control-label">Pontos de inteligencia</label>

                        <div class="col-md-12">
                            <input id="pontos_inteligencia" type="number" class="form-control" name="pontos_inteligencia" value="{{ isset($personagem) ? $personagem->pontos_inteligencia : old('pontos_inteligencia') }}" required>

                            @if ($errors->has('pontos_inteligencia'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pontos_inteligencia') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group{{ $errors->has('pontos_sabedoria') ? ' has-error' : '' }}">
                        <label for="pontos_sabedoria" class="col-md-12 control-label">Pontos de sabedoria</label>

                        <div class="col-md-12">
                            <input id="pontos_sabedoria" type="number" class="form-control" name="pontos_sabedoria" value="{{ isset($personagem) ? $personagem->pontos_sabedoria : old('pontos_sabedoria') }}" required>

                            @if ($errors->has('pontos_sabedoria'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pontos_sabedoria') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group{{ $errors->has('pontos_carisma') ? ' has-error' : '' }}">
                        <label for="pontos_carisma" class="col-md-12 control-label">Pontos de carisma</label>

                        <div class="col-md-12">
                            <input id="pontos_carisma" type="number" class="form-control" name="pontos_carisma" value="{{ isset($personagem) ? $personagem->pontos_carisma : old('pontos_carisma') }}" required>

                            @if ($errors->has('pontos_carisma'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pontos_carisma') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group{{ $errors->has('pontos_vida') ? ' has-error' : '' }}">
                        <label for="pontos_vida" class="col-md-12 control-label">Pontos de vida</label>

                        <div class="col-md-12">
                            <input id="pontos_vida" type="number" class="form-control" name="pontos_vida" value="{{ isset($personagem) ? $personagem->pontos_vida : old('pontos_vida') }}" required>

                            @if ($errors->has('pontos_vida'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pontos_vida') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                </div>

                <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                    <label for="avatar" class="col-md-12 control-label">Avatar</label>
                    
                    
                    <div class="col-md-6">

                        @isset($personagem->avatar)
                        
                            <img class="imgPersonagem" src="\img\personagem\{{ $personagem->avatar }}" alt="Imagem Personagem">
                        
                    @endisset
                        <input id="avatar" type="file" class="form-control-file" name="avatar" value="\img\personagem\{{ isset($personagem) ? $personagem->avatar : old('avatar') }}" required autofocus>
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