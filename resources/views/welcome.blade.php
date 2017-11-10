<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>RPG Play</title>

        <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <style>
            .container {
                margin-top: 100px;
            }
            .dimImg {
                width: 80px;
                height: 80px;
            };
        </style>
    </head>
    <body>
        <div class="container">
            <!--Login-->
            <div class="row justify-content-center">
                <div class="col-12 col-md-auto">
                    <div class="card">
                        <h1 class="display-4">
                            <img class="dimImg" src="/img/IMG001.gif" alt="d20">
                            RPG Play
                        </h1>
                        <div class="card-block">
                            <form method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}
                                <div class="form-group row{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-12 col-form-label">E-Mail</label>
                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-12 col-form-label">Senha</label>
                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control" name="password" required>
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!--div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Lembrar identificação do usuário
                                            </label>
                                        </div>
                                    </div>
                                </div-->
                                <!--div class="form-group row">
                                    <div class="col-md-12">
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            Esqueceu seu usuário ou senha?
                                        </a>
                                    </div>
                                </div-->
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-block btn-success">
                                            Entrar
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <a class="btn btn-block btn-primary" href="{{ route('register') }}">Cadastrar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
