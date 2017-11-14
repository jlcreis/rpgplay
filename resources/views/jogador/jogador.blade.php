@extends('layouts.app') 
@section('content')

<div class="container">
    @if($jogador)
        @if (session('msg_erro'))
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p><small>{{ session('msg_erro') }}</small></p>
            </div>
        @endif
    <div class="card">
        <div class="row justify-content-center">
            <div class="card-block">
                <div class="row">
                    <div class="col-lg-4 col-md-5">
                        <img src="/img/jogador/{{$jogador->avatar}}" width="250" heigth="250" alt="avatar">
                        <p><button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#editaAvatarModal">Editar</button></p>
                    </div>
                    <div class="col-lg-8 col-md-7">
                        <p>Usuário:</p>
                        <div class="row">
                            <div class="col col-md-auto">
                                <p class="h3">{{ $jogador->user->nome }}</p>
                            </div>
                            <div class="col ">
                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#editaUsuarioModal">Editar</button>
                            </div>
                        </div>
                        <p>E-Mail:</p>
                        <div class="row">
                            <div class="col col-md-auto">
                                <p class="h3">{{ $jogador->user->email }}</p>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#editaEmailioModal">Editar</button>
                            </div>
                        </div>
                        <p>Data de Nascimento:</p>
                        <div class="row">
                            <div class="col col-md-auto">
                                <p class="h3">{{ date('d/m/Y', strtotime ($jogador->dt_nascimento)) }}</p>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#editaNascimentoModal">Editar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-md-4 col-lg-2">
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#excluirModal">Excluir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal edita avatar do jogador -->
    <div class="modal fade" id="editaAvatarModal" tabindex="-1" role="dialog" aria-labelledby="editaAvatarModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('editaUsuario',$jogador->user->id) }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Avatar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                            <label for="avatar" class="col-md-4 control-label">Escolha seu novo avatar.</label>

                            <div class="col-md-6">
                                <input id="avatar" type="file" class="form-control-file" name="avatar" value="{{ old('avatar') }}" required autofocus>
                                <small id="fileHelp" class="form-text text-muted">Coloque uma imagem para seu seu avatar.</small>
                                @if ($errors->has('avatar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal edita nome de usuário -->
    <div class="modal fade" id="editaUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="editaUsuarioModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" method="POST" action="{{ route('editaUsuario',$jogador->user->id) }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nome de usuário</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                            <label for="nome" class="col-md-4 control-label">Nome</label>
                            <div class="col-md-6">
                                <input id="nome" type="text" maxlength="20" class="form-control" name="nome" value="{{ old('nome') }}" required autofocus>
                                @if ($errors->has('nome'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nome') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal edita e-mail -->
    <div class="modal fade" id="editaEmailioModal" tabindex="-1" role="dialog" aria-labelledby="editaEmailioModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" method="POST" action="{{ route('editaUsuario',$jogador->user->id) }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">E-mail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal edita data de nascimento -->
    <div class="modal fade" id="editaNascimentoModal" tabindex="-1" role="dialog" aria-labelledby="editaNascimentoModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" method="POST" action="{{ route('editaUsuario',$jogador->user->id) }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Data de nascimento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('dt_nascimento') ? ' has-error' : '' }}">
                            <label for="dt_nascimento" class="col-md-4 control-label">Data de Nascimento</label>
                            <div class="col-md-6">
                                <input id="dt_nascimento" type="date" class="form-control" name="dt_nascimento" value="{{ old('dt_nascimento') }}" required>

                                @if ($errors->has('dt_nascimento'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dt_nascimento') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal excluir usuario\jogador -->
    <div class="modal fade" id="excluirModal" tabindex="-1" role="dialog" aria-labelledby="excluirModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" method="POST" action="{{ route('deletarJogador',$jogador->id) }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Excluir</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <p>Deseja excluir seu cadastro?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                        <button type="submit" class="btn btn-danger">Sim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @endif

</div>

@endsection

@section('post-script')

@endsection